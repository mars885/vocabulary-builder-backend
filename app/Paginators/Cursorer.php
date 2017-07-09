<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 11/19/17
 * Time: 12:24 PM
 */

namespace App\Paginators;

use App\Model\Constants\StatusTypes;
use App\Model\Cursor;
use App\Model\Interfaces\ItemsWrappable;
use App\Utils\CursorUtils;
use App\Utils\TypeConverter;
use App\Utils\Utils;
use JsonSerializable;

class Cursorer implements JsonSerializable {


    /**
     * @var int
     */
    private $limit;

    /**
     * @var Cursor|null
     */
    private $currentCursor;

    /**
     * @var string
     */
    private $url;

    /**
     * @var ItemsWrappable|null
     */
    private $itemsWrapper;

    /**
     * @var bool
     */
    private $hasMore;




    /**
     * @param ItemsWrappable|null $itemsWrapper
     * @param Cursor|null $currentCursor
     * @param int $limit
     * @param string $url
     */
    public function __construct($itemsWrapper, $currentCursor, $limit, $url) {
        $this->itemsWrapper = $itemsWrapper;
        $this->currentCursor = $currentCursor;
        $this->limit = $limit;
        $this->url = $url;
        $this->hasMore = (Utils::isNotNull($itemsWrapper) && ($this->itemsWrapper->getItemCount() > $limit));

        if($this->hasMore) {
            $this->itemsWrapper->removeLastItem();
        }
    }




    /**
     * @return bool
     */
    public function hasNextCursor() {
        if(Utils::isNull($this->currentCursor) || CursorUtils::isNextType($this->currentCursor)) {
            return $this->hasMore;
        } else {
            return true;
        }
    }




    /**
     * @return string|null
     */
    public function getNextCursor() {
        if($this->hasNextCursor()) {
            if(Utils::isNull($this->currentCursor) || CursorUtils::isNextType($this->currentCursor)) {
                return Utils::base64Encode(TypeConverter::toString($this->itemsWrapper->getLastItem()->toCursor()));
            } else {
                return Utils::base64Encode(TypeConverter::toString($this->itemsWrapper->getFirstItem()->toCursor()));
            }
        }

        return null;
    }




    /**
     * @return bool
     */
    public function hasPreviousCursor() {
        if(Utils::isNull($this->currentCursor)) {
            return false;
        } else if(CursorUtils::isNextType($this->currentCursor)) {
            return true;
        } else {
            return $this->hasMore;
        }
    }




    /**
     * @return string|null
     */
    public function getPreviousCursor() {
        if($this->hasPreviousCursor()) {
            if(CursorUtils::isNextType($this->currentCursor)) {
                return Utils::base64Encode(TypeConverter::toString($this->itemsWrapper->getFirstItem()->toCursor()));
            } else {
                return Utils::base64Encode(TypeConverter::toString($this->itemsWrapper->getLastItem()->toCursor()));
            }
        }

        return null;
    }




    /**
     * @param string $cursorType
     * @param string $cursor
     * @return string
     */
    private function formatCursorUrl($cursorType, $cursor) {
        if(Utils::isNull($cursor)) {
            return null;
        }

        return ($this->url . 'limit=' . $this->limit . '&' . $cursorType . '=' . $cursor);
    }




    /**
     * @inheritdoc
     */
    public function jsonSerialize() {
        // Fetching necessary info
        $nextCursor = $this->getNextCursor();
        $previousCursor = $this->getPreviousCursor();
        $nextUrl = $this->formatCursorUrl(Cursor::TYPE_NEXT, $nextCursor);
        $previousUrl = $this->formatCursorUrl(Cursor::TYPE_PREVIOUS, $previousCursor);

        // Returning JSON with fetched info
        return [
            'status' => StatusTypes::SUCCESS,
            'paging' => [
                'cursors' => [
                    'next' => $nextCursor,
                    'previous' => $previousCursor
                ],
                'urls' => [
                    'next' => $nextUrl,
                    'previous' => $previousUrl
                ],
                'limit' => $this->limit
            ],
            'data' => $this->itemsWrapper
        ];
    }




}