<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/21/17
 * Time: 10:18 PM
 */

namespace App\Model;

use App\Utils\Utils;
use DateTime;
use JsonSerializable;

abstract class OAuthBaseToken implements JsonSerializable {


    const JSON_PROPERTY_ID = 'id';
    const JSON_PROPERTY_EXPIRES_IN = 'expires_in';
    const JSON_PROPERTY_IS_REVOKED = 'is_revoked';


    /**
     * @var string
     */
    protected $id;

    /**
     * @var DateTime|null
     */
    protected $expiryDateTime;

    /**
     * @var bool|null
     */
    protected $isRevoked;




    public function __construct() {
        $this->id = '';
        $this->expiryDateTime = null;
        $this->isRevoked = null;
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




    /**
     * @param DateTime|null $expiryDateTime
     * @return $this
     */
    public function setExpiryDateTime(DateTime $expiryDateTime) {
        $this->expiryDateTime = $expiryDateTime;
        return $this;
    }




    /**
     * @return DateTime|null
     */
    public function getExpiryDateTime() {
        return $this->expiryDateTime;
    }




    /**
     * @return bool
     */
    public function hasExpiryDateTime() {
        return Utils::isNotNull($this->expiryDateTime);
    }




    /**
     * @param bool|null $isRevoked
     * @return $this
     */
    public function setRevoked($isRevoked) {
        $this->isRevoked = $isRevoked;
        return $this;
    }




    /**
     * @return bool|null
     */
    public function isRevoked() {
        return $this->isRevoked;
    }




    /**
     * @return bool
     */
    public function hasIsRevoked() {
        return Utils::isNotNull($this->isRevoked);
    }




    /**
     * @inheritdoc
     */
    public function jsonSerialize() {
        $results = array();

        if($this->hasId()) {
            $results[self::JSON_PROPERTY_ID] = $this->id;
        }

        if($this->hasExpiryDateTime()) {
            $results[self::JSON_PROPERTY_EXPIRES_IN] = $this->getExpiryDateTime()->getTimestamp();
        }

        if($this->hasIsRevoked()) {
            $results[self::JSON_PROPERTY_IS_REVOKED] = $this->isRevoked;
        }

        return $results;
    }




}