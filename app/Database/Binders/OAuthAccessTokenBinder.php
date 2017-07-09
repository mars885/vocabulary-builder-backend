<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/29/17
 * Time: 4:53 AM
 */

namespace App\Database\Binders;

use App\Database\Placeholders\OAuthAccessTokenPlaceholders;
use PDOStatement;

abstract class OAuthAccessTokenBinder {




    /**
     * @param PDOStatement $statement
     * @param mixed $value
     */
    public static function bindAccessTokenIdParameter($statement, $value) {
        Binder::bindStringParameter($statement, OAuthAccessTokenPlaceholders::ACCESS_TOKEN_ID, $value);
    }




    /**
     * @param PDOStatement $statement
     * @param mixed $value
     */
    public static function bindOwnerTypeParameter($statement, $value) {
        Binder::bindStringParameter($statement, OAuthAccessTokenPlaceholders::OWNER_TYPE, $value);
    }




    /**
     * @param PDOStatement $statement
     * @param mixed $value
     */
    public static function bindOwnerIdParameter($statement, $value) {
        Binder::bindStringParameter($statement, OAuthAccessTokenPlaceholders::OWNER_ID, $value);
    }




}