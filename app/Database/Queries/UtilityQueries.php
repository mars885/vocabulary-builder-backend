<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/29/17
 * Time: 10:26 PM
 */

namespace App\Database\Queries;

abstract class UtilityQueries {




    /**
     * @return string
     */
    public static function getForeignKeyChecksDisablingQuery() {
        return 'SET FOREIGN_KEY_CHECKS = 0';
    }




    /**
     * @return string
     */
    public static function getForeignKeyChecksEnablingQuery() {
        return 'SET FOREIGN_KEY_CHECKS = 1';
    }




}