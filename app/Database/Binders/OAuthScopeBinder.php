<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/29/17
 * Time: 4:20 AM
 */

namespace App\Database\Binders;

use App\Database\Placeholders\OAuthScopePlaceholders;
use PDOStatement;

abstract class OAuthScopeBinder {




    /**
     * @param PDOStatement $statement
     * @param mixed $value
     */
    public static function bindPermissionParameter($statement, $value) {
        Binder::bindStringParameter($statement, OAuthScopePlaceholders::PERMISSION, $value);
    }




    /**
     * @param PDOStatement $statement
     * @param mixed $value
     */
    public static function bindDomainParameter($statement, $value) {
        Binder::bindStringParameter($statement, OAuthScopePlaceholders::DOMAIN, $value);
    }




}