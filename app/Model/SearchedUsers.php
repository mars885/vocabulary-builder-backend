<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/24/17
 * Time: 12:13 AM
 */

namespace App\Model;

class SearchedUsers extends ItemsWrapper {




    public function __construct() {
        parent::__construct();
    }




    /**
     * @inheritdoc
     */
    public function jsonSerialize() {
        return $this->items;
    }




}