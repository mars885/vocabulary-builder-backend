<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/8/17
 * Time: 10:23 PM
 */

namespace App\Model;

class Followers extends ItemsWrapper {




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