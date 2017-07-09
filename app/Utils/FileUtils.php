<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/15/17
 * Time: 7:19 PM
 */

namespace App\Utils;

abstract class FileUtils {




    /**
     * @param null|string $fileName
     * @return bool
     */
    public static function fileExists($fileName) {
        if(Utils::isInvalid($fileName)) {
            return false;
        }

        return file_exists($fileName);
    }




    /**
     * @param null|string $fileName
     * @return bool
     */
    public static function isFileReadable($fileName) {
        if(Utils::isInvalid($fileName)) {
            return false;
        }

        return is_readable($fileName);
    }




    /**
     * @param null|string $fileName
     * @return bool|int
     */
    public static function getFilePermissions($fileName) {
        if(Utils::isInvalid($fileName)) {
            return 0;
        }

        return fileperms($fileName);
    }




}