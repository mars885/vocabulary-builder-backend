<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/9/17
 * Time: 12:57 AM
 */

namespace App\Model;

class FriendIds extends ItemsWrapper {




    public function __construct() {
        parent::__construct();
    }




    /**
     * @return array
     */
    private function fetchIds() {
        $ids = array();

        /** @var Friend $item */
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