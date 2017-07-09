<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/31/17
 * Time: 11:23 AM
 */

namespace App\Model\Parameters;

use App\Model\Cursor;
use App\Utils\Utils;

class CursorParameters {


    /**
     * @var int
     */
    protected $limit;

    /**
     * @var Cursor|null
     */
    protected $nextCursor;

    /**
     * @var Cursor|null
     */
    protected $previousCursor;




    public function __construct() {
        $this->limit = -1;
        $this->nextCursor = null;
        $this->previousCursor = null;
    }




    /**
     * @param int $limit
     * @return $this
     */
    public function setLimit($limit) {
        $this->limit = $limit;
        return $this;
    }




    /**
     * @return int
     */
    public function getLimit() {
        return $this->limit;
    }




    /**
     * @return int
     */
    public function getLimitAdjustedForDatabase() {
        return ($this->limit + 1);
    }




    /**
     * @return bool
     */
    public function hasLimit() {
        return ($this->limit !== -1);
    }




    /**
     * @param Cursor $nextCursor
     * @return $this
     */
    public function setNextCursor($nextCursor) {
        $this->nextCursor = $nextCursor;
        return $this;
    }




    /**
     * @return Cursor|null
     */
    public function getNextCursor() {
        return $this->nextCursor;
    }




    /**
     * @return bool
     */
    public function hasNextCursor() {
        return Utils::isNotNull($this->nextCursor);
    }




    /**
     * @param Cursor $previousCursor
     * @return $this
     */
    public function setPreviousCursor($previousCursor) {
        $this->previousCursor = $previousCursor;
        return $this;
    }




    /**
     * @return Cursor|null
     */
    public function getPreviousCursor() {
        return $this->previousCursor;
    }




    /**
     * @return bool
     */
    public function hasPreviousCursor() {
        return Utils::isNotNull($this->previousCursor);
    }




    /**
     * @return Cursor|null
     */
    public function getCursor() {
        if(self::hasNextCursor()) {
            return self::getNextCursor();
        } else if(self::hasPreviousCursor()) {
            return self::getPreviousCursor();
        } else {
            return null;
        }
    }




    /**
     * @param string $key
     *
     * @return mixed|null
     */
    public function getParameter($key) {
        if(!self::hasCursor()) {
            return null;
        }

        return self::getCursor()->getParameter($key)->getValue();
    }




    /**
     * @return bool
     */
    public function hasCursor() {
        return (self::hasNextCursor() || self::hasPreviousCursor());
    }




}