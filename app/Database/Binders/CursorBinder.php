<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/29/17
 * Time: 3:10 AM
 */

namespace App\Database\Binders;

use App\Database\Placeholders\CursorPlaceholders;
use PDOStatement;

abstract class CursorBinder {




    /**
     * @param PDOStatement $statement
     * @param mixed $value
     */
    public static function bindIdParameter($statement, $value) {
        Binder::bindIntegerParameter($statement, CursorPlaceholders::ID, $value);
    }




    /**
     * @param PDOStatement $statement
     * @param mixed $value
     */
    public static function bindFollowerCountParameter($statement, $value) {
        Binder::bindIntegerParameter($statement, CursorPlaceholders::FOLLOWER_COUNT, $value);
    }




    /**
     * @param PDOStatement $statement
     * @param mixed $value
     */
    public static function bindCreatedAtParameter($statement, $value) {
        Binder::bindStringParameter($statement, CursorPlaceholders::CREATED_AT, $value);
    }




    /**
     * @param PDOStatement $statement
     * @param mixed $value
     */
    public static function bindLimitParameter($statement, $value) {
        Binder::bindIntegerParameter($statement, CursorPlaceholders::LIMIT, $value);
    }




}