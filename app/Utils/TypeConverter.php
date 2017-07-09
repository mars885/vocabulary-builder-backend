<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 11/22/17
 * Time: 8:21 PM
 */

namespace App\Utils;

abstract class TypeConverter {




    /**
     * @param mixed $parameter
     * @return bool
     */
    public static function toBoolean($parameter) {
        if(TypeRecognizer::isString($parameter)) {
            return ArrayUtils::contains($parameter, ['1', 'true', 'on', 'yes', 'y']);
        }

        return boolval($parameter);
    }




    /**
     * @param mixed $parameter
     * @return int
     */
    public static function toInteger($parameter) {
        return intval($parameter);
    }




    /**
     * @param mixed $parameter
     * @return float
     */
    public static function toFloat($parameter) {
        return floatval($parameter);
    }




    /**
     * @param mixed $parameter
     * @return string
     */
    public static function toString($parameter) {
        return strval($parameter);
    }




}