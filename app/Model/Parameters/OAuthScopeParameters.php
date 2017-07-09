<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/31/17
 * Time: 5:26 PM
 */

namespace App\Model\Parameters;

use App\Utils\Utils;

class OAuthScopeParameters {


    /**
     * @var string
     */
    protected $permission;

    /**
     * @var string
     */
    protected $domain;

    /**
     * @var string
     */
    protected $clientId;

    /**
     * @var string
     */
    protected $grantType;




    public function __construct() {
        $this->permission = '';
        $this->domain = '';
        $this->clientId = '';
        $this->grantType = '';
    }




    /**
     * @param string $permission
     * @return $this
     */
    public function setPermission($permission) {
        $this->permission = $permission;
        return $this;
    }





    /**
     * @return string
     */
    public function getPermission() {
        return $this->permission;
    }




    /**
     * @return bool
     */
    public function hasPermission() {
        return Utils::isNotEmpty($this->permission);
    }




    /**
     * @param string $domain
     * @return $this
     */
    public function setDomain($domain) {
        $this->domain = $domain;
        return $this;
    }




    /**
     * @return string
     */
    public function getDomain() {
        return $this->domain;
    }




    /**
     * @return bool
     */
    public function hasDomain() {
        return Utils::isNotEmpty($this->domain);
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