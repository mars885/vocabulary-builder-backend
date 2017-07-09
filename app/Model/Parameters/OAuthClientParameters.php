<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/31/17
 * Time: 1:13 PM
 */

namespace App\Model\Parameters;

use App\Utils\Utils;

class OAuthClientParameters {


    /**
     * @var string
     */
    protected $clientId;

    /**
     * @var string
     */
    protected $grantType;




    public function __construct() {
        $this->clientId = '';
        $this->grantType = '';
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
     * @param string $grantType
     * @return $this
     */
    public function setGrantType($grantType) {
        $this->grantType = $grantType;
        return $this;
    }




    /**
     * @return string
     */
    public function getGrantType() {
        return $this->grantType;
    }



    /**
     * @return bool
     */
    public function hasGrantType() {
        return Utils::isNotEmpty($this->grantType);
    }




}