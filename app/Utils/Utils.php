<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 7/11/17
 * Time: 12:49 AM
 */

namespace App\Utils;

use App\Model\Cursor;
use App\Model\Pronunciation;
use Slim\Http\Request;

abstract class Utils {




    /**
     * @param mixed $var
     * @return bool
     */
    public static function isNull($var) {
        return is_null($var);
    }




    /**
     * @param mixed $var
     * @return bool
     */
    public static function isNotNull($var) {
        return !self::isNull($var);
    }




    /**
     * @param mixed $var
     * @return bool
     */
    public static function isSet($var) {
        return isset($var);
    }




    /**
     * @param mixed $var
     * @return bool
     */
    public static function isNotSet($var) {
        return !self::isSet($var);
    }




    /**
     * @param mixed $var
     * @return bool
     */
    public static function isEmpty($var) {
        return empty($var);
    }




    /**
     * @param mixed $var
     * @return bool
     */
    public static function isNotEmpty($var) {
        return !self::isEmpty($var);
    }




    /**
     * @param mixed $var
     * @return bool
     */
    public static function isValid($var) {
        return (self::isSet($var) && self::isNotEmpty($var));
    }




    /**
     * @param mixed $var
     * @return bool
     */
    public static function isInvalid($var) {
        return !self::isValid($var);
    }




    /**
     * @param object $obj
     * @return string
     */
    public static function getClassNameWithoutNamespace($obj) {
        if(self::isInvalid($obj)) {
            return '';
        }

        return (new \ReflectionClass($obj))->getShortName();
    }




    /**
     * @param int|null $x
     * @param int|null $y
     * @return int|null
     */
    public static function min($x, $y) {
        if(self::isNull($x) || self::isNull($y)) {
            return null;
        }

        return (($x > $y) ? $y : $x);
    }




    /**
     * @param int|null $x
     * @param int|null $y
     * @return int|null
     */
    public static function max(int $x, int $y) {
        if(self::isNull($x) || self::isNull($y)) {
            return null;
        }

        return (($x > $y) ? $x : $y);
    }




    /**
     * @param null|string $base
     * @param null|string $relative
     * @return string
     */
    public static function concatBaseUrlWithRelative($base, $relative) {
        if(self::isInvalid($base) || self::isInvalid($relative)) {
            return '';
        }

        return ($base . '/' . $relative);
    }




    /**
     * @param null|array $accentsConfig
     * @param null|string $audioFilePath
     * @return array
     */
    public static function getAudioPronunciations($accentsConfig, $audioFilePath) {
        if(self::isInvalid($accentsConfig) || self::isInvalid($audioFilePath)) {
            return array();
        }

        $pronunciations = array();

        foreach($accentsConfig as $accent => $baseUrl) {
            $pronunciation = new Pronunciation();
            $pronunciation->setAccent($accent);
            $pronunciation->setUrl(self::concatBaseUrlWithRelative($baseUrl, $audioFilePath));

            $pronunciations[] = $pronunciation;
        }

        return $pronunciations;
    }




    /**
     * @param int $length
     * @return string
     */
    public static function generateUniqueString($length) {
        if($length < 2) {
            return '';
        }

        return bin2hex(random_bytes($length / 2));
    }




    /**
     * @param string $fileName
     * @return array
     */
    public static function fetchDatabaseDataFromResources($fileName) {
        if(self::isNull($fileName)) {
            return [];
        }

        $fileHandle = fopen(__DIR__ . '/../../resources/database/data/' . $fileName, 'r');
        $rows = [];

        if($fileHandle) {
            while(($line = fgets($fileHandle)) !== false) {
                $columnValueStrArray = ArrayUtils::explode('#', trim($line));

                foreach($columnValueStrArray as $columnValueStr) {
                    $columnValue = ArrayUtils::explode(':', $columnValueStr);
                    $column = $columnValue[0];
                    $value = $columnValue[1];

                    $row[$column] = (($value === '') ? null : $value);
                }

                $rows[] = $row;
            }

            fclose($fileHandle);
        }

        return $rows;
    }




    /**
     * @param string|null $data
     * @return string
     */
    public static function base64Encode($data) {
        if(self::isInvalid($data)) {
            return '';
        }

        return base64_encode($data);
    }




    /**
     * @param string|null $data
     * @return string
     */
    public static function base64Decode($data) {
        if(self::isInvalid($data)) {
            return '';
        }

        return base64_decode($data);
    }




    /**
     * @param Request $request
     *
     * @return string
     */
    public static function getUrlForCursorer($request) {
        $uri = $request->getUri();
        $scheme = $uri->getScheme();
        $host = $uri->getHost();
        $path = $uri->getPath();

        $queryParams = $request->getQueryParams();
        $query = '';

        foreach($queryParams as $key => $value) {
            if(($key !== 'limit') && ($key !== Cursor::TYPE_NEXT) && ($key !== Cursor::TYPE_PREVIOUS)) {
                $query .= ($key . '=' . $value . '&');
            }
        }

        return ($scheme . '://' . $host . $path . '?' . $query);
    }




}