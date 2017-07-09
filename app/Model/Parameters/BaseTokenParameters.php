<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/31/17
 * Time: 4:48 PM
 */

namespace App\Model\Parameters;

use App\Utils\Utils;

abstract class BaseTokenParameters {


    /**
     * @var bool
     */
    protected $isRevoked;

    /**
     * @var int
     */
    protected $expiryTime;

    /**
     * @var string
     */
    protected $id;




    public function __construct() {
        $this->isRevoked = false;
        $this->expiryTime = -1;
        $this->id = '';
    }




    /**
     * @param bool $isRevoked
     * @return $this
     */
    public function setRevoked($isRevoked) {
        $this->isRevoked = $isRevoked;
        return $this;
    }




    /**
     * @return bool
     */
    public function isRevoked() {
        return $this->isRevoked;
    }




    /**
     * @param int $expiryTime
     * @return $this
     */
    public function setExpiryTime($expiryTime) {
        $this->expiryTime = $expiryTime;
        return $this;
    }




    /**
     * @return int
     */
    public function getExpiryTime() {
        return $this->expiryTime;
    }




    /**
     * @return bool
     */
    public function hasExpiryTime() {
        return ($this->expiryTime !== -1);
    }




    /**
     * @param string $id
     * @return $this
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }




    /**
     * @return string
     */
    public function getId() {
        return $this->id;
    }




    /**
     * @return bool
     */
    public function hasId() {
        return Utils::isNotEmpty($this->id);
    }




}