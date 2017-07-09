<?php

/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 9/25/17
 * Time: 2:33 AM
 */

namespace App\Paginators;

use App\Utils\ArrayUtils;

class Paginator implements \JsonSerializable {


    /**
     * @var int
     */
    private $currentPage;

    /**
     * @var int
     */
    private $perPage;

    /**
     * @var string
     */
    private $url;

    /**
     * @var array
     */
    private $items;

    /**
     * @var bool
     */
    private $hasNextPage;

    /**
     * @var bool
     */
    private $hasPreviousPage;




    /**
     * @param array $items
     * @param int $currentPage
     * @param int $perPage
     * @param string $url
     */
    public function __construct($items, $currentPage, $perPage, $url) {
        $this->items = $items;
        $this->currentPage = $currentPage;
        $this->perPage = $perPage;
        $this->url = $url;
        $this->hasNextPage = (ArrayUtils::getSize($items) > $perPage);
        $this->hasPreviousPage = ($currentPage > 1);
    }




    /**
     * @return int
     */
    public function getCurrentPage() {
        return $this->currentPage;
    }




    /**
     * @return int
     */
    public function getPerPage() {
        return $this->perPage;
    }




    /**
     * @return string
     */
    public function getUrl() {
        return $this->url;
    }




    /**
     * @return array
     */
    public function getItems() {
        return $this->items;
    }




    /**
     * @return bool
     */
    public function hasNextPage() {
        return $this->hasNextPage;
    }




    /**
     * @return bool
     */
    public function hasPreviousPage() {
        return $this->hasPreviousPage;
    }




    /**
     * @return int|null
     */
    public function nextPage() {
        if($this->hasNextPage()) {
            return ($this->currentPage + 1);
        }

        return null;
    }




    /**
     * @return int|null
     */
    public function previousPage() {
        if($this->hasPreviousPage()) {
            return ($this->currentPage - 1);
        }

        return null;
    }




    /**
     * @return null|string
     */
    public function nextPageUrl() {
        if($this->hasNextPage()) {
            return self::url($this->nextPage());
        }

        return null;
    }




    /**
     * @return null|string
     */
    public function previousPageUrl() {
        if($this->hasPreviousPage()) {
            return self::url($this->previousPage());
        }

        return null;
    }




    /**
     * @param int $page
     * @return string
     */
    private function url($page) {
        return ($this->url . '?page=' . $page . '&perPage=' . $this->getPerPage());
    }




    public function jsonSerialize() {
        return [
            'status' => 'success',
            'paging' => [
                'next_page' => $this->nextPage(),
                'next_page_url' => $this->nextPageUrl(),
                'previous_page' => $this->previousPage(),
                'previous_page_url' => $this->previousPageUrl(),
                'current_page' => $this->currentPage,
                'per_page' => $this->perPage
            ],
            'data' => $this->items
        ];
    }




}