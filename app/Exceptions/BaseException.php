<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/15/17
 * Time: 4:06 PM
 */

namespace App\Exceptions;

use App\Utils\Utils;

abstract class BaseException extends \Exception {


    /**
     * @var string
     */
    private $errorType;


    /**
     * @var null|string
     */
    private $hint;




    /**
     * @param string $message
     * @param int $code
     * @param string $errorType
     * @param string $hint
     */
    public function __construct($message, $code, $errorType, $hint = null) {
        parent::__construct($message, $code);

        $this->errorType = $errorType;
        $this->hint = $hint;
    }




    /**
     * @param string $errorType
     */
    public function setErrorType($errorType) {
        $this->errorType = $errorType;
    }




    /**
     * @param string $hint
     */
    public function setHint($hint) {
        $this->hint = $hint;
    }




    /**
     * @return string
     */
    public function getErrorType() {
        return $this->errorType;
    }




    /**
     * @return null|string
     */
    public function getHint() {
        return $this->hint;
    }




    /**
     * @return bool
     */
    public function hasHint() {
        return Utils::isNotNull($this->hint);
    }




}