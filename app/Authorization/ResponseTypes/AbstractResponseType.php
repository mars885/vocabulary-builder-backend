<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/15/17
 * Time: 11:34 PM
 */

namespace App\Authorization\ResponseTypes;

use App\Authorization\Encryption\CryptKey;
use App\Authorization\Encryption\CryptTrait;
use App\Authorization\ResponseTypes\Interfaces\ResponseTypeInterface;
use App\Model\OAuthAccessToken;
use App\Model\OAuthRefreshToken;

abstract class AbstractResponseType implements ResponseTypeInterface {


    use CryptTrait;

    /**
     * @var OAuthAccessToken
     */
    protected $accessToken;

    /**
     * @var OAuthRefreshToken
     */
    protected $refreshToken;

    /**
     * @var CryptKey
     */
    protected $privateKey;

    /**
     * @var string
     */
    protected $scopeDelimiter;




    /**
     * {@inheritdoc}
     */
    public function setAccessToken($accessToken) {
        $this->accessToken = $accessToken;
    }




    /**
     * {@inheritdoc}
     */
    public function setRefreshToken($refreshToken) {
        $this->refreshToken = $refreshToken;
    }




    /**
     * Set the private key.
     *
     * @param CryptKey $privateKey
     */
    public function setPrivateKey($privateKey) {
        $this->privateKey = $privateKey;
    }




    /**
     * @param string $scopeDelimiter
     */
    public function setScopeDelimiter($scopeDelimiter) {
        $this->scopeDelimiter = $scopeDelimiter;
    }




}