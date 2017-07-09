<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/21/17
 * Time: 9:37 PM
 */

namespace App\Model;

use App\Utils\Utils;

class OAuthRefreshToken extends OAuthBaseToken {


    const JSON_PROPERTY_ACCESS_TOKEN = 'access_token';


    /**
     * @var OAuthAccessToken|null
     */
    protected $accessToken;




    /**
     * @param OAuthAccessToken $accessToken
     * @return OAuthRefreshToken
     */
    public static function create($accessToken) {
        $refreshToken = new self();
        $refreshToken->setAccessToken($accessToken);

        return $refreshToken;
    }




    public function __construct() {
        parent::__construct();

        $this->accessToken = null;
    }




    /**
     * @param OAuthAccessToken|null $accessToken
     */
    public function setAccessToken($accessToken) {
        $this->accessToken = $accessToken;
    }




    /**
     * @return OAuthAccessToken|null
     */
    public function getAccessToken() {
        return $this->accessToken;
    }




    /**
     * @return bool
     */
    public function hasAccessToken() {
        return Utils::isNotNull($this->accessToken);
    }




    /**
     * @inheritdoc
     */
    public function jsonSerialize() {
        $results = parent::jsonSerialize();

        if($this->hasAccessToken()) {
            $results[self::JSON_PROPERTY_ACCESS_TOKEN] = $this->accessToken;
        }

        return $results;
    }




}