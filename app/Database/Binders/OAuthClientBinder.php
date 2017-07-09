<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/29/17
 * Time: 4:08 AM
 */

namespace App\Database\Binders;

use App\Database\Placeholders\OAuthClientPlaceholders;
use PDOStatement;

abstract class OAuthClientBinder {




    /**
     * @param PDOStatement $statement
     * @param mixed $value
     */
    public static function bindClientIdParameter($statement, $value) {
        Binder::bindStringParameter($statement, OAuthClientPlaceholders::CLIENT_ID, $value);
    }





}