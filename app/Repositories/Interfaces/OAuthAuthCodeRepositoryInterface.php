<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/15/17
 * Time: 5:05 PM
 */

namespace App\Repositories\Interfaces;

use App\Exceptions\UniqueTokenIdentifierConstraintViolationException;
use App\Model\OAuthAuthCode;

interface OAuthAuthCodeRepositoryInterface {


    /**
     * Get token for identifier passed.
     *
     * @return mixed
     */
    public function getNewAuthCode();


    /**
     * Persists a new authorization code to permanent storage (e.g. a database).
     *
     * @param OAuthAuthCode $authCode
     *
     * @throws UniqueTokenIdentifierConstraintViolationException
     */
    public function persistNewAuthCode($authCode);


    /**
     * Revoke an auth token.
     *
     * @param string $codeId
     */
    public function revokeAuthCode($codeId);


    /**
     * Check if the auth code is revoked.
     *
     * @param string $codeId
     *
     * @return bool return true if the code has been revoked
     */
    public function isAuthCodeRevoked($codeId);


}