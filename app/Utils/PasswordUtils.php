<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/21/17
 * Time: 7:04 PM
 */

namespace App\Utils;

abstract class PasswordUtils {




    /**
     * @param string|null $password
     * @param array $options
     *
     * @return bool|string
     */
    public static function hashPassword($password, $options = ['cost' => 10]) {
        if(Utils::isNull($password)) {
            return '';
        }

        return password_hash($password, PASSWORD_DEFAULT, $options);
    }




    /**
     * @param string|null $password
     * @param string|null $hash
     *
     * @return bool
     */
    public static function verifyPassword($password, $hash) {
        if(Utils::isNull($password) || Utils::isNull($hash)) {
            return false;
        }

        return password_verify($password, $hash);
    }




}