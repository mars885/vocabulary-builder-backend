<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 11/21/17
 * Time: 4:03 PM
 */

namespace App\Model;

use App\Utils\Utils;

abstract class BaseModel {


    const JSON_PROPERTY_CREATED_AT = 'created_at';
    const JSON_PROPERTY_UPDATED_AT = 'updated_at';


    /**
     * @var string
     */
    protected $createdAt;

    /**
     * @var string
     */
    protected $updatedAt;




    protected function __construct() {
        $this->createdAt = '';
        $this->updatedAt = '';
    }




    /**
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
        return $this;
    }




    /**
     * @return string
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }




    /**
     * @return bool
     */
    public function hasCreatedAt() {
        return Utils::isNotEmpty($this->createdAt);
    }




    /**
     * @param string $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt) {
        $this->updatedAt = $updatedAt;
        return $this;
    }




    /**
     * @return string
     */
    public function getUpdatedAt() {
        return $this->updatedAt;
    }




    /**
     * @return bool
     */
    public function hasUpdatedAt() {
        return Utils::isNotEmpty($this->updatedAt);
    }




}