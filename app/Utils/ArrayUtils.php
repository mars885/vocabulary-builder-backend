<?php

/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 7/11/17
 * Time: 1:58 AM
 */

namespace App\Utils;

abstract class ArrayUtils {




    /**
     * @param null|string $key
     * @param null|array $array
     * @return bool
     */
    public static function keyExists($key, $array) {
        if(Utils::isNull($key) || Utils::isInvalid($array)) {
            return false;
        }

        return array_key_exists($key, $array);
    }




    /**
     * @param null|array $array
     * @return int
     */
    public static function getSize($array) {
        if(Utils::isInvalid($array)) {
            return 0;
        }

        return count($array);
    }




    /**
     * @param null|array $array
     * @return bool
     */
    public static function isEmpty($array) {
        return (self::getSize($array) > 0);
    }




    /**
     * @param mixed $needle
     * @param null|array $haystack
     * @param bool $strict
     * @return bool
     */
    public static function contains($needle, $haystack, $strict = false) {
        if(Utils::isInvalid($needle) || Utils::isInvalid($haystack)) {
            return false;
        }

        return in_array($needle, $haystack, $strict);
    }




    /**
     * @param null|array $array
     * @return array
     */
    public static function removeDuplicates($array) {
        if(Utils::isInvalid($array)) {
            return array();
        }

        return self::extractValues(array_unique($array));
    }




    /**
     * @param array|null $array
     * @param callable $callback
     * @return array
     */
    public static function filter($array, $callback) {
        if(Utils::isInvalid($array) || Utils::isNull($callback)) {
            return array();
        }

        return array_filter($array, $callback);
    }




    /**
     * @param null|array $array1
     * @param null|array $array2
     * @return array
     */
    public static function merge($array1, $array2) {
        if(Utils::isNull($array1) || Utils::isNull($array2)) {
            return array();
        }

        return array_merge($array1, $array2);
    }




    /**
     * @param array|null $array
     * @return array
     */
    public static function extractValues($array) {
        if(Utils::isNull($array)) {
            return array();
        }

        return array_values($array);
    }




    /**
     * @param array|null $array1
     * @param array|null $array2
     * @return array
     */
    public static function intersect($array1, $array2) {
        if(Utils::isNull($array1) || Utils::isNull($array2)) {
            return array();
        }

        return array_intersect($array1, $array2);
    }




    /**
     * @param array|null $array1
     * @param array|null $array2
     * @return array
     */
    public static function findDifference($array1, $array2) {
        if(Utils::isNull($array1) || Utils::isNull($array2)) {
            return array();
        }

        return array_diff($array1, $array2);
    }




    /**
     * @param array|null $array1
     * @param array|null $array2
     * @param callable $dataCompareFunc
     * @return array
     */
    public static function findDifferenceWithObjects($array1, $array2, $dataCompareFunc) {
        if(Utils::isNull($array1) || Utils::isNull($array2)) {
            return array();
        }

        return array_udiff($array1, $array2, $dataCompareFunc);
    }




    /**
     * @param array|null $keys
     * @param array|null $values
     * @return array
     */
    public static function combine($keys, $values) {
        if(Utils::isNull($keys) || Utils::isNull($values)) {
            return array();
        }

        return array_combine($keys, $values);
    }




    /**
     * @param array|null $array
     * @return array|mixed
     */
    public static function removeFirstElement(&$array) {
        if(Utils::isNull($array)) {
            return array();
        }

        return array_shift($array);
    }




    /**
     * @param array|null $array
     * @return array|mixed
     */
    public static function removeLastElement(&$array) {
        if(Utils::isNull($array)) {
            return array();
        }

        return array_pop($array);
    }




    /**
     * @param null|string $delimiter
     * @param null|string $text
     * @return array
     */
    public static function explode($delimiter, $text) {
        if(Utils::isInvalid($delimiter) || Utils::isInvalid($text)) {
            return array();
        }

        return explode($delimiter, $text);
    }




    /**
     * @param array|null $array
     * @return bool
     */
    public static function hasDuplicates($array) {
        if(Utils::isInvalid($array)) {
            return false;
        }

        return (self::getSize($array) !== self::getSize(self::removeDuplicates($array)));
    }




}