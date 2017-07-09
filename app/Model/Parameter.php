<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 1/6/18
 * Time: 7:16 PM
 */

namespace App\Model;

class Parameter {


    const DELIMITER = '=';


    /**
     * @var string
     */
    private $key;

    /**
     * @var mixed|null
     */
    private $value;




    public function __construct() {
        $this->key = '';
        $this->value = null;
    }




    /**
     * @param string $key
     * @return $this
     */
    public function setKey($key) {
        $this->key = $key;
        return $this;
    }




    /**
     * @return string
     */
    public function getKey() {
        return $this->key;
    }




    /**
     * @param mixed|null $value
     * @return $this
     */
    public function setValue($value) {
        $this->value = $value;
        return $this;
    }




    /**
     * @return mixed|null
     */
    public function getValue() {
        return $this->value;
    }




    /**
     * @inheritdoc
     */
    public function __toString() {
        return ($this->key . self::DELIMITER . $this->value);
    }




}