<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/8/17
 * Time: 12:57 AM
 */

namespace App\Database\Utils;

use App\Utils\ArrayUtils;
use App\Utils\TypeConverter;
use App\Utils\Utils;

abstract class CursorCommon {




    /**
     * @param array $cursor
     * @param string $column
     * @param string $defaultValue
     * @return string
     */
    public static function getString($cursor, $column, $defaultValue = '') {
        return ((Utils::isValid($cursor) && ArrayUtils::keyExists($column, $cursor) && Utils::isNotNull($cursor[$column])) ? TypeConverter::toString($cursor[$column]) : $defaultValue);
    }




    /**
     * @param array $cursor
     * @param string $column
     * @param int $defaultValue
     * @return int
     */
    public static function getInt($cursor, $column, $defaultValue = -1) {
        return ((Utils::isValid($cursor) && ArrayUtils::keyExists($column, $cursor) && Utils::isNotNull($cursor[$column])) ? TypeConverter::toInteger($cursor[$column]) : $defaultValue);
    }




    /**
     * @param array $cursor
     * @param string $column
     * @param bool $defaultValue
     * @return bool
     */
    public static function getBoolean($cursor, $column, $defaultValue = null) {
        return ((Utils::isValid($cursor) && ArrayUtils::keyExists($column, $cursor) && Utils::isNotNull($cursor[$column])) ? TypeConverter::toBoolean($cursor[$column]) : $defaultValue);
    }




}