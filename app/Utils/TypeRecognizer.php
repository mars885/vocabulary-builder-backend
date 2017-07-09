<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 11/22/17
 * Time: 12:05 AM
 */

namespace App\Utils;

abstract class TypeRecognizer {




    /**
     * @param $parameter
     *
     * @return bool
     */
    public static function isBoolean($parameter) {
        if(is_bool($parameter)) {
            return true;
        } else if(self::isString($parameter)) {
            return ArrayUtils::contains($parameter, ['1', 'true', 'on', 'yes', 'y']);
        } else {
            return false;
        }
    }




    /**
     * @param $parameter
     *
     * @return bool
     */
    public static function isInteger($parameter) {
        if(is_int($parameter)) {
            return true;
        } else if(self::isString($parameter)) {
            return ctype_digit($parameter);
        } else {
            return false;
        }
    }




    /**
     * @param $parameter
     *
     * @return bool
     */
    public static function isFloat($parameter) {
        if(is_float($parameter)) {
            return true;
        } else if(self::isString($parameter)) {
            return ($parameter == (string)(float)$parameter);
        } else {
            return false;
        }
    }




    /**
     * @param $parameter
     *
     * @return bool
     */
    public static function isString($parameter) {
        return is_string($parameter);
    }




    /**
     * @param $parameter
     *
     * @return bool
     */
    public static function isArray($parameter) {
        return is_array($parameter);
    }




    /**
     * @param $parameter
     *
     * @return bool
     */
    public static function isObject($parameter) {
        return is_object($parameter);
    }




}