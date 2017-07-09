<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 11/21/17
 * Time: 4:12 PM
 */

namespace App\Model\Interfaces;

use App\Model\Cursor;

interface Cursorable {


    /**
     * Implement this method to make a model cursorable.
     *
     * @return Cursor A model's unique property (e.g., id, created_at, etc.)
     */
    public function toCursor();


}