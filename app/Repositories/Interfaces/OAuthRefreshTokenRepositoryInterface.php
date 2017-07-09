<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/19/17
 * Time: 12:25 AM
 */

namespace App\Repositories\Interfaces;

use App\Exceptions\UniqueTokenIdentifierConstraintViolationException;
use App\Model\OAuthRefreshToken;

interface OAuthRefreshTokenRepositoryInterface {


    /**
     * Persists a new refresh token to the permanent storage.
     *
     * @param OAuthRefreshToken $refreshToken
     *
     * @throws UniqueTokenIdentifierConstraintViolationException
     */
    public function persistNewRefreshToken($refreshToken);


    /**
     * Revoke the refresh token.
     *
     * @param string $tokenId
     *
     * @throw DatabaseOperationException
     */
    public function revokeRefreshToken($tokenId);


    /**
     * Check if the refresh token has been revoked.
     *
     * @param string $tokenId
     *
     * @return bool Return true if this token has been revoked
     */
    public function isRefreshTokenRevoked($tokenId);


}