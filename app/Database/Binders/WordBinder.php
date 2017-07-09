<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/29/17
 * Time: 3:13 AM
 */

namespace App\Database\Binders;

use App\Database\Placeholders\WordPlaceholders;
use PDOStatement;

abstract class WordBinder {




    /**
     * @param PDOStatement $statement
     * @param mixed $value
     */
    public static function bindWordParameter($statement, $value) {
        Binder::bindStringParameter($statement, WordPlaceholders::WORD, $value);
    }




    /**
     * @param PDOStatement $statement
     * @param mixed $value
     */
    public static function bindPartOfSpeechParameter($statement, $value) {
        Binder::bindStringParameter($statement, WordPlaceholders::PART_OF_SPEECH, $value);
    }






}