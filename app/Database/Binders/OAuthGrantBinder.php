<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/29/17
 * Time: 4:22 AM
 */

namespace App\Database\Binders;

use App\Database\Placeholders\OAuthGrantPlaceholders;
use PDOStatement;

abstract class OAuthGrantBinder {




    /**
     * @param PDOStatement $statement
     * @param mixed $value
     */
    public static function bindGrantTypeParameter($statement, $value) {
        Binder::bindStringParameter($statement, OAuthGrantPlaceholders::GRANT_TYPE, $value);
    }




}