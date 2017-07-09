<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/25/17
 * Time: 1:28 AM
 */

namespace App\Database\Mappers;

use App\Utils\Utils;
use PDO;
use PDOStatement;

abstract class BaseMapper {


    /**
     * @var PDO
     */
    private $handler;




    /**
     * @param PDO $handler
     */
    protected function __construct(PDO $handler) {
        $this->handler = $handler;
    }




    /**
     * @param string $query
     * @return PDOStatement
     */
    protected function prepareQuery($query) {
        return $this->handler->prepare($query);
    }




    /**
     * @param PDOStatement $statement
     * @return bool
     */
    protected function executeStatement($statement) {
        if(Utils::isInvalid($statement)) {
            return false;
        }

        return ($statement->execute() && ($statement->rowCount() > 0));
    }




    /**
     * @return PDO
     */
    protected function getHandler() {
        return $this->handler;
    }




}