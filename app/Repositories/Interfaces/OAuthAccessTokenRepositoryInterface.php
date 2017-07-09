<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/15/17
 * Time: 5:04 PM
 */

namespace App\Repositories\Interfaces;

use App\Exceptions\UniqueTokenIdentifierConstraintViolationException;
use App\Model\OAuthAccessToken;

interface OAuthAccessTokenRepositoryInterface {


    /**
     * Persists a new access token to permanent storage (e.g. a database).
     *
     * @param OAuthAccessToken $accessToken
     *
     * @throws UniqueTokenIdentifierConstraintViolationException
     */
    public function persistNewAccessToken($accessToken);


    /**
     * Revoke an access token.
     *
     * @param string $tokenId
     *
     * @throw DatabaseOperationException
     */
    public function revokeAccessToken($tokenId);


    /**
     * Check if the access token is revoked.
     *
     * @param string $tokenId
     *
     * @return bool return true if the token has been revoked
     */
    public function isAccessTokenRevoked($tokenId);


}