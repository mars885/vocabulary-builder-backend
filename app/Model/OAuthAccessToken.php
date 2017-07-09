<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/21/17
 * Time: 9:37 PM
 */

namespace App\Model;

use App\Utils\Utils;

class OAuthAccessToken extends OAuthBaseToken {


    const JSON_PROPERTY_CLIENT = 'client';
    const JSON_PROPERTY_SCOPES = 'scopes';
    const JSON_PROPERTY_OWNER_TYPE = 'owner_type';
    const JSON_PROPERTY_OWNER_ID = 'owner_id';


    /**
     * @var OAuthClient|null
     */
    protected $client;

    /**
     * @var OAuthScope[]|null
     */
    protected $scopes;

    /**
     * @var string
     */
    protected $ownerType;

    /**
     * @var string|int|null
     */
    protected $ownerId;




    /**
     * @param OAuthClient   $client    The client
     * @param OAuthScope[]  $scopes    An array of Scope objects
     * @param string        $ownerType The owner type (either 'user' or 'client')
     * @param string|int    $ownerId   Either the client's id or user's identifier. Depends on
     *                                 what grant type is used.
     * @return OAuthAccessToken
     */
    public static function create($client, $scopes, $ownerType, $ownerId) {
        $accessToken = new self();
        $accessToken->setClient($client);
        $accessToken->setScopes($scopes);
        $accessToken->setOwnerType($ownerType);
        $accessToken->setOwnerId($ownerId);

        return $accessToken;
    }




    public function __construct() {
        parent::__construct();

        $this->client = null;
        $this->scopes = null;
        $this->ownerType = '';
        $this->ownerId = null;
    }




    /**
     * @param OAuthClient|null $client
     * @return $this
     */
    public function setClient($client) {
        $this->client = $client;
        return $this;
    }




    /**
     * @return OAuthClient|null
     */
    public function getClient() {
        return $this->client;
    }




    /**
     * @return bool
     */
    public function hasClient() {
        return Utils::isNotNull($this->client);
    }




    /**
     * @param OAuthScope[]|null $scopes
     * @return $this
     */
    public function setScopes($scopes) {
        $this->scopes = $scopes;
        return $this;
    }




    /**
     * @return OAuthScope[]|null
     */
    public function getScopes() {
        return $this->scopes;
    }




    /**
     * @return bool
     */
    public function hasScopes() {
        return Utils::isNotNull($this->scopes);
    }




    /**
     * @param OAuthScope|null $scope
     */
    public function addScope($scope) {
        $scopes[] = $scope;
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
     * @param int|string|null $ownerId
     * @return $this
     */
    public function setOwnerId($ownerId) {
        $this->ownerId = $ownerId;
        return $this;
    }




    /**
     * @return int|string|null
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




    /**
     * @inheritdoc
     */
    public function jsonSerialize() {
        $results = parent::jsonSerialize();

        if($this->hasClient()) {
            $results[self::JSON_PROPERTY_CLIENT] = $this->client;
        }

        if($this->hasScopes()) {
            $results[self::JSON_PROPERTY_SCOPES] = $this->scopes;
        }

        if($this->hasOwnerType()) {
            $results[self::JSON_PROPERTY_OWNER_TYPE] = $this->ownerType;
        }

        if($this->hasOwnerId()) {
            $results[self::JSON_PROPERTY_OWNER_ID] = $this->ownerId;
        }

        return $results;
    }




}