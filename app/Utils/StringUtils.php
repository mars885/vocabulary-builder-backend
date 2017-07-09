<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 7/12/17
 * Time: 7:41 PM
 */

namespace App\Utils;

abstract class StringUtils {




    /**
     * @param null|string $input
     * @param null|int $multiplier
     * @return string
     */
    public static function repeat($input, $multiplier) {
        if(Utils::isInvalid($input) || Utils::isInvalid($multiplier)) {
            return '';
        }

        return str_repeat($input, $multiplier);
    }




    /**
     * @param null|string $haystack
     * @param null|string $needle
     * @return bool
     */
    public static function contains($haystack, $needle) {
        if(Utils::isInvalid($haystack) || Utils::isInvalid($needle)) {
            return false;
        }

        return (strpos($haystack, $needle) !== false);
    }




    /**
     * @param null|string $haystack
     * @param null|string $needle
     * @return bool
     */
    public static function startsWith($haystack, $needle) {
        if(Utils::isNull($haystack) || Utils::isNull($needle)) {
            return false;
        }

        return (substr($haystack, 0, strlen($needle)) === $needle);
    }




    /**
     * @param null|string $haystack
     * @param null|string $needle
     * @return bool
     */
    public static function endsWith($haystack, $needle) {
        if(Utils::isNull($haystack) || Utils::isNull($needle)) {
            return false;
        }

        $needleLength = strlen($needle);

        return (($needleLength === 0) || (substr($haystack, -$needleLength) === $needle));
    }




    /**
     * @param null|string $text
     * @return string
     */
    public static function toLowerCase($text) {
        if(Utils::isInvalid($text)) {
            return '';
        }

        return strtolower($text);
    }




    /**
     * @param null|string $text
     * @return string
     */
    public static function toUpperCase($text) {
        if(Utils::isInvalid($text)) {
            return '';
        }

        return strtoupper($text);
    }




    /**
     * @param null|string $text
     * @return string
     */
    public static function trim($text) {
        if(Utils::isInvalid($text)) {
            return '';
        }

        return trim($text);
    }




    /**
     * @param string|null $glue
     * @param array|null $pieces
     * @return string
     */
    public static function implode($glue, $pieces) {
        if(Utils::isNull($glue) || Utils::isNull($pieces)) {
            return '';
        }

        return implode($glue, $pieces);
    }




}