<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/9/17
 * Time: 12:57 AM
 */

namespace App\Model;

class Friends extends ItemsWrapper {





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