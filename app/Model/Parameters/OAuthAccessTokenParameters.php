<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/31/17
 * Time: 1:12 PM
 */

namespace App\Model\Parameters;

use App\Utils\Utils;

class OAuthAccessTokenParameters extends BaseTokenParameters {


    /**
     * @var string
     */
    protected $ownerType;

    /**
     * @var string
     */
    protected $clientId;

    /**
     * @var string|int|null
     */
    protected $ownerId;




    public function __construct() {
        parent::__construct();

        $this->ownerType = '';
        $this->clientId = '';
        $this->ownerId = null;
    }




    /**
     * @param string $ownerType
     * @return $this
     */
    public function setOwnerType($ownerType) {
        $this->ownerType = $ownerType;
        return $this;
    }




    /**
     * @return string
     */
    public function getOwnerType() {
        return $this->ownerType;
    }




    /**
     * @return bool
     */
    public function hasOwnerType() {
        return Utils::isNotEmpty($this->ownerType);
    }




    /**
     * @param string $clientId
     * @return $this
     */
    public function setClientId($clientId) {
        $this->clientId = $clientId;
        return $this;
    }




    /**
     * @return string
     */
    public function getClientId() {
        return $this->clientId;
    }




    /**
     * @return bool
     */
    public function hasClientId() {
        return Utils::isNotEmpty($this->clientId);
    }




    /**
     * @param string|int $ownerId
     * @return $this
     */
    public function setOwnerId($ownerId) {
        $this->ownerId = $ownerId;
        return $this;
    }




    /**
     * @return string|int|null
     */
    public function getOwnerId() {
        return $this->ownerId;
    }




    /**
     * @return bool
     */
    public function hasOwnerId() {
        return Utils::isNotNull($this->ownerId);
    }




}