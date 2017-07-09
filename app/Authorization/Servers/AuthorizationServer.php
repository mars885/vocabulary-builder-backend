<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/15/17
 * Time: 6:34 PM
 */

namespace App\Authorization\Servers;

use App\Authorization\Encryption\CryptKey;
use App\Authorization\Grants\Interfaces\GrantInterface;
use App\Authorization\ResponseTypes\BearerTokenResponse;
use App\Authorization\ResponseTypes\Interfaces\ResponseTypeInterface;
use App\Exceptions\OAuth2Exception;
use App\Repositories\Interfaces\OAuthAccessTokenRepositoryInterface;
use App\Repositories\Interfaces\OAuthClientRepositoryInterface;
use App\Repositories\Interfaces\OAuthScopeRepositoryInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class AuthorizationServer {


    /**
     * @var GrantInterface[]
     */
    protected $enabledGrantTypes = [];

    /**
     * @var \DateInterval[]
     */
    protected $grantTypeAccessTokensTTL = [];

    /**
     * @var CryptKey
     */
    private $privateKey;

    /**
     * @var null|ResponseTypeInterface
     */
    private $responseType;

    /**
     * @var OAuthClientRepositoryInterface
     */
    private $clientRepository;

    /**
     * @var OAuthAccessTokenRepositoryInterface
     */
    private $accessTokenRepository;

    /**
     * @var OAuthScopeRepositoryInterface
     */
    private $scopeRepository;

    /**
     * @var string
     */
    private $encryptionKey;

    /**
     * @var string
     */
    private $scopeDelimiter;




    /**
     * New server instance.
     *
     * @param OAuthClientRepositoryInterface      $clientRepository      The client repository
     * @param OAuthAccessTokenRepositoryInterface $accessTokenRepository The access token repository
     * @param OAuthScopeRepositoryInterface       $scopeRepository       The scope repository
     * @param string                              $privateKeyPath        Path to the private key
     * @param string                              $encryptionKey         Encryption key
     * @param string                              $scopeDelimiter        The scope's parameter delimiter
     * @param ResponseTypeInterface|null          $responseType          Response type
     */
    public function __construct(
        $clientRepository,
        $accessTokenRepository,
        $scopeRepository,
        $privateKeyPath,
        $encryptionKey,
        $scopeDelimiter,
        $responseType = null
    ) {
        $this->clientRepository = $clientRepository;
        $this->accessTokenRepository = $accessTokenRepository;
        $this->scopeRepository = $scopeRepository;
        $this->privateKey = new CryptKey($privateKeyPath);
        $this->encryptionKey = $encryptionKey;
        $this->scopeDelimiter = $scopeDelimiter;
        $this->responseType = $responseType;
    }




    /**
     * Enable a grant type on the server.
     *
     * @param GrantInterface $grant
     * @param \DateInterval $accessTokenTTL
     */
    public function enableGrantType($grant, $accessTokenTTL) {
        $grant->setClientRepository($this->clientRepository);
        $grant->setAccessTokenRepository($this->accessTokenRepository);
        $grant->setScopeRepository($this->scopeRepository);
        $grant->setPrivateKey($this->privateKey);
        $grant->setEncryptionKey($this->encryptionKey);
        $grant->setScopeDelimiter($this->scopeDelimiter);

        $this->enabledGrantTypes[$grant->getId()] = $grant;
        $this->grantTypeAccessTokensTTL[$grant->getId()] = $accessTokenTTL;
    }





    public function validateAuthorizationRequest($request) {

    }





    public function completeAuthorizationRequest($authRequest, $response) {

    }




    /**
     * Return an access token response.
     *
     * @param Request $request
     * @param Response $response
     *
     * @throws OAuth2Exception
     *
     * @return Response
     */
    public function respondToTokenRequest($request, $response) {
        foreach($this->enabledGrantTypes as $grantType) {
            if($grantType->canRespondToTokenRequest($request)) {
                $tokenResponse = $grantType->respondToTokenRequest(
                    $request,
                    $this->getResponseType(),
                    $this->grantTypeAccessTokensTTL[$grantType->getId()]
                );

                if($tokenResponse instanceof ResponseTypeInterface) {
                    return $tokenResponse->generateHttpResponse($response);
                };
            }
        }

        throw OAuth2Exception::unsupportedGrantType();
    }




    /**
     * Get the token type that grants will return in the HTTP response.
     *
     * @return ResponseTypeInterface
     */
    protected function getResponseType() {
        if(($this->responseType instanceof ResponseTypeInterface) === false) {
            $this->responseType = new BearerTokenResponse();
        }

        $this->responseType->setPrivateKey($this->privateKey);
        $this->responseType->setEncryptionKey($this->encryptionKey);
        $this->responseType->setScopeDelimiter($this->scopeDelimiter);

        return $this->responseType;
    }




}