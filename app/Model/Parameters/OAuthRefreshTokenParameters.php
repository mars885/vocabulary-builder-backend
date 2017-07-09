<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/31/17
 * Time: 1:13 PM
 */

namespace App\Model\Parameters;

use App\Utils\Utils;

class OAuthRefreshTokenParameters extends BaseTokenParameters {


    /**
     * @var string
     */
    protected $accessTokenId;




    public function __construct() {
        parent::__construct();

        $this->accessTokenId = '';
    }




    /**
     * @param string $accessTokenId
     * @return $this
     */
    public function setAccessTokenId($accessTokenId) {
        $this->accessTokenId = $accessTokenId;
        return $this;
    }




    /**
     * @return string
     */
    public function getAccessTokenId() {
        return $this->accessTokenId;
    }




    /**
     * @return bool
     */
    public function hasAccessTokenId() {
        return Utils::isNotEmpty($this->accessTokenId);
    }




}