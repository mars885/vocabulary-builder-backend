<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 11/26/17
 * Time: 4:32 PM
 */

namespace App\Model\Constants;

abstract class OAuthScopePermissions {


    const READ_ID = 1;
    const READ = 'r';

    const WRITE_ID = 2;
    const WRITE = 'w';




    /**
     * @return array
     */
    public static function getAsArray() {
        return [
            [
                self::READ_ID,
                self::READ
            ],
            [
                self::WRITE_ID,
                self::WRITE
            ]
        ];
    }




    /**
     * @return array
     */
    public static function getIdsAsArray() {
        return [self::READ_ID, self::WRITE_ID];
    }




    /**
     * @return array
     */
    public static function getPermissionsAsArray() {
        return [self::READ, self::WRITE];
    }




}