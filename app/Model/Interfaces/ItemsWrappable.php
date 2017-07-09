<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/9/17
 * Time: 12:09 AM
 */

namespace App\Model\Interfaces;

interface ItemsWrappable {


    /**
     * A method for removing the first item from the data set.
     *
     * @return bool
     */
    public function removeFirstItem();


    /**
     * A method for removing the last item from the data set.
     *
     * @return bool
     */
    public function removeLastItem();


    /**
     * A method for retrieving a number of items.
     *
     * @return int
     */
    public function getItemCount();


    /**
     * A method for retrieving the first item.
     *
     * @return Cursorable
     */
    public function getFirstItem();


    /**
     * A method for retrieving the last item.
     *
     * @return Cursorable
     */
    public function getLastItem();


}