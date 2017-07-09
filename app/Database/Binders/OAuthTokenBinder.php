<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/29/17
 * Time: 5:09 AM
 */

namespace App\Database\Binders;

use App\Database\Placeholders\OAuthTokenPlaceholders;
use PDOStatement;

abstract class OAuthTokenBinder {




    /**
     * @param PDOStatement $statement
     * @param mixed $value
     */
    public static function bindExpiryTimeParameter($statement, $value) {
        Binder::bindIntegerParameter($statement, OAuthTokenPlaceholders::EXPIRY_TIME, $value);
    }




    /**
     * @param PDOStatement $statement
     * @param mixed $value
     */
    public static function bindIsRevokedParameter($statement, $value) {
        Binder::bindBooleanParameter($statement, OAuthTokenPlaceholders::IS_REVOKED, $value);
    }




}