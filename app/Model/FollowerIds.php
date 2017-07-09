<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/8/17
 * Time: 11:03 PM
 */

namespace App\Model;

class FollowerIds extends ItemsWrapper {




    public function __construct() {
        parent::__construct();
    }




    /**
     * @return array
     */
    private function fetchIds() {
        $ids = array();

        /** @var Follower $item */
        foreach($this->items as $item) {
            $ids[] = $item->getId();
        }

        return $ids;
    }




    /**
     * @inheritdoc
     */
    public function jsonSerialize() {
        return $this->fetchIds();
    }




}