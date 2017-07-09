<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/29/17
 * Time: 2:54 AM
 */

namespace App\Database\Binders;

use App\Database\Placeholders\UserPlaceholders;
use PDOStatement;

abstract class UserBinder {




    /**
     * @param PDOStatement $statement
     * @param mixed $value
     */
    public static function bindUserIdParameter($statement, $value) {
        Binder::bindIntegerParameter($statement, UserPlaceholders::USER_ID, $value);
    }




    /**
     * @param PDOStatement $statement
     * @param mixed $values
     */
    public static function bindUserIdsParameter($statement, $values) {
        foreach($values as $index => $value) {
            Binder::bindIntegerParameter($statement, (UserPlaceholders::USER_ID . $index), $value);
        }
    }




    /**
     * @param PDOStatement $statement
     * @param mixed $value
     */
    public static function bindEmailParameter($statement, $value) {
        Binder::bindStringParameter($statement, UserPlaceholders::EMAIL, $value);
    }




    /**
     * @param PDOStatement $statement
     * @param mixed $value
     */
    public static function bindQueryParameter($statement, $value) {
        Binder::bindStringParameter($statement, UserPlaceholders::QUERY, $value);
    }




    /**
     * @param PDOStatement $statement
     * @param mixed $value
     */
    public static function bindFollowerIdParameter($statement, $value) {
        Binder::bindIntegerParameter($statement, UserPlaceholders::FOLLOWER_ID, $value);
    }




    /**
     * @param PDOStatement $statement
     * @param mixed $value
     */
    public static function bindFriendIdParameter($statement, $value) {
        Binder::bindIntegerParameter($statement, UserPlaceholders::FRIEND_ID, $value);
    }




}