<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/9/17
 * Time: 12:24 AM
 */

namespace App\Model;

use App\Model\Interfaces\Cursorable;
use App\Model\Interfaces\ItemsWrappable;
use App\Utils\ArrayUtils;
use App\Utils\Utils;
use JsonSerializable;

abstract class ItemsWrapper implements ItemsWrappable, JsonSerializable {


    /**
     * @var Cursorable
     */
    protected $items;




    protected function __construct() {
        $this->items = array();
    }




    /**
     * @param Cursorable $items
     * @return $this
     */
    public function setItems($items) {
        $this->items = $items;
        return $this;
    }




    /**
     * @param Cursorable $item
     * @return $this
     */
    public function addItem($item) {
        $this->items[] = $item;
        return $this;
    }




    /**
     * @return Cursorable[]
     */
    public function getItems() {
        return $this->items;
    }




    /**
     * @return bool
     */
    public function hasItems() {
        return Utils::isNotEmpty($this->items);
    }




    /**
     * @return void
     */
    public function removeFirstItem() {
        ArrayUtils::removeFirstElement($this->items);
    }




    /**
     * @return void
     */
    public function removeLastItem() {
        ArrayUtils::removeLastElement($this->items);
    }




    /**
     * @return int
     */
    public function getItemCount() {
        return ArrayUtils::getSize($this->items);
    }




    /**
     * @return Cursorable
     */
    public function getFirstItem() {
        return $this->items[0];
    }




    /**
     * @return Cursorable
     */
    public function getLastItem() {
        return $this->items[$this->getItemCount() - 1];
    }




}