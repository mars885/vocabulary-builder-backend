<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/15/17
 * Time: 7:28 PM
 */

namespace App\Authorization\Grants\Interfaces;

use App\Authorization\Encryption\CryptKey;
use App\Authorization\RequestTypes\AuthorizationRequest;
use App\Authorization\ResponseTypes\Interfaces\ResponseTypeInterface as Response;
use App\Repositories\Interfaces\OAuthAccessTokenRepositoryInterface;
use App\Repositories\Interfaces\OAuthClientRepositoryInterface;
use App\Repositories\Interfaces\OAuthScopeRepositoryInterface;
use Slim\Http\Request;

interface GrantInterface {


    /**
     * Respond to an incoming request.
     *
     * @param Request       $request
     * @param Response      $response
     * @param \DateInterval $accessTokenTTL
     *
     * @return Response
     */
    public function respondToTokenRequest($request, $response, $accessTokenTTL);


    /**
     * If the grant can respond to an authorization request, this method should be called to validate the parameters of
     * the request.
     * If the validation is successful, an AuthorizationRequest object will be returned. This object can be safely
     * serialized in a user's session, and can be used during user authentication and authorization.
     *
     * @param Request $request
     *
     * @return AuthorizationRequest
     */
    public function validateAuthorizationRequest($request);


    /**
     * Once a user has authenticated and authorized the client, the grant can complete the authorization request.
     * The AuthorizationRequest object's $userId property must be set to the authenticated user and the
     * $authorizationApproved property must reflect their desire to authorize or deny the client.
     *
     * @param AuthorizationRequest $authorizationRequest
     *
     * @return Response
     */
    public function completeAuthorizationRequest($authorizationRequest);


    /**
     * Set the client repository.
     *
     * @param OAuthClientRepositoryInterface $clientRepository
     */
    public function setClientRepository($clientRepository);


    /**
     * Set the access token repository.
     *
     * @param OAuthAccessTokenRepositoryInterface $accessTokenRepository
     */
    public function setAccessTokenRepository($accessTokenRepository);


    /**
     * Set the scope repository.
     *
     * @param OAuthScopeRepositoryInterface $scopeRepository
     */
    public function setScopeRepository($scopeRepository);


    /**
     * Set the path to the private key.
     *
     * @param CryptKey $privateKey
     */
    public function setPrivateKey($privateKey);


    /**
     * Set the encryption key.
     *
     * @param string $encryptionKey
     */
    public function setEncryptionKey($encryptionKey);


    /**
     * Set the scope delimiter.
     *
     * @param string $scopeDelimiter
     */
    public function setScopeDelimiter($scopeDelimiter);


    /**
     * Return the grant identifier that can be used in matching up requests.
     *
     * @return string
     */
    public function getId();


    /**
     * The grant type should return true if it is able to respond to this request.
     * For example, most grant types will check that the $_POST['grant_type'] property matches it's identifier property.
     *
     * @param Request $request
     *
     * @return bool
     */
    public function canRespondToTokenRequest($request);


    /**
     * The grant type should return true if it is able to response to an authorization request.
     *
     * @param Request $request
     *
     * @return bool
     */
    public function canRespondToAuthorizationRequest($request);


}