<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/21/17
 * Time: 9:38 PM
 */

namespace App\Model;

use App\Model\Constants\OAuthScopePermissions;
use App\Utils\Utils;
use JsonSerializable;

class OAuthScope implements JsonSerializable {


    const JSON_PROPERTY_ID = 'id';
    const JSON_PROPERTY_PERMISSION = 'permission';
    const JSON_PROPERTY_DOMAIN = 'domain';
    const JSON_PROPERTY_DESCRIPTION = 'description';

    const PART_DELIMITER = ':';


    /**
     * @var int
     */
    protected $id;

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
    protected $description;




    /**
     * @param string $domain
     * @return $this
     */
    public static function withRead($domain) {
        return (new OAuthScope())->setPermission(OAuthScopePermissions::READ)->setDomain($domain);
    }




    /**
     * @param string $domain
     * @return $this
     */
    public static function withWrite($domain) {
        return (new OAuthScope())->setPermission(OAuthScopePermissions::WRITE)->setDomain($domain);
    }




    public function __construct() {
        $this->id = -1;
        $this->permission = '';
        $this->domain = '';
        $this->description = '';
    }




    /**
     * @param int $id
     * @return $this
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }




    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }




    /**
     * @return bool
     */
    public function hasId() {
        return ($this->id > 0);
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
     * @param string $description
     * @return $this
     */
    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }




    /**
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }




    /**
     * @return bool
     */
    public function hasDescription() {
        return Utils::isNotEmpty($this->description);
    }




    /**
     * @inheritdoc
     */
    public function jsonSerialize() {
        $results = array();

        if($this->hasId()) {
            $results[self::JSON_PROPERTY_ID] = $this->id;
        }

        if($this->hasPermission()) {
            $results[self::JSON_PROPERTY_PERMISSION] = $this->permission;
        }

        if($this->hasDomain()) {
            $results[self::JSON_PROPERTY_DOMAIN] = $this->domain;
        }

        if($this->hasDescription()) {
            $results[self::JSON_PROPERTY_DESCRIPTION] = $this->description;
        }

        return $results;
    }




    /**
     * Returns the name of the scope as a string representation.
     *
     * @return string
     */
    public function __toString() {
        return ($this->permission . self::PART_DELIMITER . $this->domain);
    }




}