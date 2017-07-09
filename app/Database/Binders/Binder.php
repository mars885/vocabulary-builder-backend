<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/29/17
 * Time: 2:49 AM
 */

namespace App\Database\Binders;

use App\Utils\Utils;
use PDO;
use PDOStatement;

abstract class Binder {




    /**
     * @param PDOStatement $statement
     * @param string $placeholder
     * @param mixed $value
     * @param int $dataType
     */
    public static function bindParameter($statement, $placeholder, $value, $dataType) {
        if(Utils::isNull($statement)
            || Utils::isInvalid($placeholder)
            || Utils::isInvalid($value)
            || Utils::isNull($dataType)) {
            return;
        }

        // Binding the parameter with the specified value and data type
        $statement->bindValue($placeholder, $value, $dataType);
    }




    /**
     * @param PDOStatement $statement
     * @param string $placeholder
     * @param mixed $value
     */
    public static function bindBooleanParameter($statement, $placeholder, $value) {
        self::bindParameter($statement, $placeholder, $value, PDO::PARAM_BOOL);
    }




    /**
     * @param PDOStatement $statement
     * @param string $placeholder
     * @param mixed $value
     */
    public static function bindIntegerParameter($statement, $placeholder, $value) {
        self::bindParameter($statement, $placeholder, $value, PDO::PARAM_INT);
    }




    /**
     * @param PDOStatement $statement
     * @param string $placeholder
     * @param mixed $value
     */
    public static function bindStringParameter($statement, $placeholder, $value) {
        self::bindParameter($statement, $placeholder, $value, PDO::PARAM_STR);
    }




}