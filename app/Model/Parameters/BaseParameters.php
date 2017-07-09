<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/31/17
 * Time: 11:24 AM
 */

namespace App\Model\Parameters;

abstract class BaseParameters {


    /**
     * @var bool
     */
    protected $isClientFirstParty;

    /**
     * @var int
     */
    protected $authUserId;




    protected function __construct() {
        $this->isClientFirstParty = false;
        $this->authUserId = -1;
    }




    /**
     * @param bool $isClientFirstParty
     * @return $this
     */
    public function setClientFirstParty($isClientFirstParty) {
        $this->isClientFirstParty = $isClientFirstParty;
        return $this;
    }




    /**
     * @return bool
     */
    public function isClientFirstParty() {
        return $this->isClientFirstParty;
    }




    /**
     * @param int $authUserId
     * @return $this
     */
    public function setAuthUserId($authUserId) {
        $this->authUserId = $authUserId;
        return $this;
    }




    /**
     * @return int
     */
    public function getAuthUserId() {
        return $this->authUserId;
    }




    /**
     * @return bool
     */
    public function hasAuthUserId() {
        return ($this->authUserId !== -1);
    }




}