<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/21/17
 * Time: 9:37 PM
 */

namespace App\Model;

use App\Utils\Utils;

class OAuthClient implements \JsonSerializable {


    const JSON_PROPERTY_ID = 'id';
    const JSON_PROPERTY_SECRET = 'secret';
    const JSON_PROPERTY_TYPE = 'type';
    const JSON_PROPERTY_REDIRECT_URLS = 'redirect_urls';
    const JSON_PROPERTY_OWNER_ID = 'owner_id';
    const JSON_PROPERTY_IS_FIRST_PARTY = 'is_first_party';
    const JSON_PROPERTY_NAME = 'name';
    const JSON_PROPERTY_DESCRIPTION = 'description';
    const JSON_PROPERTY_LOGO_FILE_PATH = 'logo_file_path';

    const CLIENT_ID_LENGTH = 32;
    const CLIENT_SECRET_LENGTH = 50;


    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $secret;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string|string[]|null
     */
    protected $redirectUrls;

    /**
     * @var int
     */
    protected $ownerId;

    /**
     * @var bool|null
     */
    protected $isFirstParty;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $logoFilePath;




    public function __construct() {
        $this->id = '';
        $this->secret = '';
        $this->type = '';
        $this->redirectUrls = null;
        $this->ownerId = -1;
        $this->isFirstParty = null;
        $this->name = '';
        $this->description = '';
        $this->logoFilePath = '';
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
     * @param string $secret
     * @return $this
     */
    public function setSecret($secret) {
        $this->secret = $secret;
        return $this;
    }




    /**
     * @return string
     */
    public function getSecret() {
        return $this->secret;
    }




    /**
     * @return bool
     */
    public function hasSecret() {
        return Utils::isNotEmpty($this->secret);
    }




    /**
     * @param string $type
     * @return $this
     */
    public function setType($type) {
        $this->type = $type;
        return $this;
    }




    /**
     * @return string
     */
    public function getType() {
        return $this->type;
    }




    /**
     * @return bool
     */
    public function hasType() {
        return Utils::isNotEmpty($this->type);
    }




    /**
     * @param string|string[]|null $redirectUrls
     * @return $this
     */
    public function setRedirectUrls($redirectUrls) {
        $this->redirectUrls = $redirectUrls;
        return $this;
    }




    /**
     * @return string|string[]|null
     */
    public function getRedirectUrls() {
        return $this->redirectUrls;
    }




    /**
     * @return bool
     */
    public function hasRedirectUrls() {
        return Utils::isNotNull($this->redirectUrls);
    }




    /**
     * @param int $ownerId
     * @return $this
     */
    public function setOwnerId($ownerId) {
        $this->ownerId = $ownerId;
        return $this;
    }




    /**
     * @return int
     */
    public function getOwnerId() {
        return $this->ownerId;
    }




    /**
     * @return bool
     */
    public function hasOwnerId() {
        return ($this->ownerId > 0);
    }




    /**
     * @param bool|null $isFirstParty
     * @return $this
     */
    public function setFirstParty($isFirstParty) {
        $this->isFirstParty = $isFirstParty;
        return $this;
    }




    /**
     * @return bool|null
     */
    public function isFirstParty() {
        return $this->isFirstParty;
    }




    /**
     * @return bool
     */
    public function hasIsFirstParty() {
        return Utils::isNotNull($this->isFirstParty);
    }




    /**
     * @param string $name
     * @return $this
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }




    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }




    /**
     * @return bool
     */
    public function hasName() {
        return Utils::isNotEmpty($this->name);
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
     * @param string $logoFilePath
     * @return $this
     */
    public function setLogoFilePath($logoFilePath) {
        $this->logoFilePath = $logoFilePath;
        return $this;
    }




    /**
     * @return string
     */
    public function getLogoFilePath() {
        return $this->logoFilePath;
    }




    /**
     * @return bool
     */
    public function hasLogoFilePath() {
        return Utils::isNotEmpty($this->logoFilePath);
    }




    /**
     * @inheritdoc
     */
    public function jsonSerialize() {
        $results = array();

        if($this->hasId()) {
            $results[self::JSON_PROPERTY_ID] = $this->id;
        }

        if($this->hasSecret()) {
            $results[self::JSON_PROPERTY_SECRET] = $this->secret;
        }

        if($this->hasType()) {
            $results[self::JSON_PROPERTY_TYPE] = $this->type;
        }

        if($this->hasRedirectUrls()) {
            $results[self::JSON_PROPERTY_REDIRECT_URLS] = $this->redirectUrls;
        }

        if($this->hasOwnerId()) {
            $results[self::JSON_PROPERTY_OWNER_ID] = $this->ownerId;
        }

        if($this->hasIsFirstParty()) {
            $results[self::JSON_PROPERTY_IS_FIRST_PARTY] = $this->isFirstParty;
        }

        if($this->hasName()) {
            $results[self::JSON_PROPERTY_NAME] = $this->name;
        }

        if($this->hasDescription()) {
            $results[self::JSON_PROPERTY_DESCRIPTION] = $this->description;
        }

        if($this->hasLogoFilePath()) {
            $results[self::JSON_PROPERTY_LOGO_FILE_PATH] = $this->logoFilePath;
        }

        return $results;
    }




}