<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/15/17
 * Time: 7:45 PM
 */

namespace App\Authorization\ResponseTypes\Interfaces;

use App\Model\OAuthRefreshToken;
use Slim\Http\Response;

interface ResponseTypeInterface {


    /**
     * @param Response $response
     *
     * @return Response
     */
    public function generateHttpResponse($response);


    /**
     * @param \App\Model\OAuthAccessToken $accessToken
     */
    public function setAccessToken($accessToken);


    /**
     * @param OAuthRefreshToken $refreshToken
     */
    public function setRefreshToken($refreshToken);


    /**
     * Set the encryption key.
     *
     * @param string $key
     */
    public function setEncryptionKey($key);


}