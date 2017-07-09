<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/29/17
 * Time: 5:04 AM
 */

namespace App\Database\Binders;

use App\Database\Placeholders\OAuthRefreshTokenPlaceholders;
use PDOStatement;

abstract class OAuthRefreshTokenBinder {




    /**
     * @param PDOStatement $statement
     * @param mixed $value
     */
    public static function bindRefreshTokenIdParameter($statement, $value) {
        Binder::bindStringParameter($statement, OAuthRefreshTokenPlaceholders::REFRESH_TOKEN_ID, $value);
    }




}