<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/15/17
 * Time: 8:01 PM
 */

namespace App\Authorization\Grants;

use App\Authorization\Encryption\CryptKey;
use App\Authorization\Encryption\CryptTrait;
use App\Authorization\Grants\Interfaces\GrantInterface;
use App\Exceptions\BadRequestException;
use App\Exceptions\OAuth2Exception;
use App\Exceptions\UniqueTokenIdentifierConstraintViolationException;
use App\Model\Constants\OAuthGrantTypes;
use App\Model\Constants\OAuthOwnerTypes;
use App\Model\OAuthAccessToken;
use App\Model\OAuthClient;
use App\Model\OAuthRefreshToken;
use App\Model\OAuthScope;
use App\Repositories\Interfaces\OAuthAccessTokenRepositoryInterface;
use App\Repositories\Interfaces\OAuthAuthCodeRepositoryInterface;
use App\Repositories\Interfaces\OAuthClientRepositoryInterface;
use App\Repositories\Interfaces\OAuthRefreshTokenRepositoryInterface;
use App\Repositories\Interfaces\OAuthScopeRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Utils\ArrayUtils;
use App\Utils\OAuthScopeUtils;
use App\Utils\Utils;
use Slim\Http\Request;

abstract class BaseGrant implements GrantInterface {


    use CryptTrait;


    const MAX_TOKEN_GENERATION_ATTEMPTS = 10;

    const ACCESS_TOKEN_ID_LENGTH = 40;
    const REFRESH_TOKEN_ID_LENGTH = 40;


    /**
     * @var OAuthClientRepositoryInterface
     */
    protected $clientRepository;

    /**
     * @var OAuthAccessTokenRepositoryInterface
     */
    protected $accessTokenRepository;

    /**
     * @var OAuthScopeRepositoryInterface
     */
    protected $scopeRepository;

    /**
     * @var UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * @var OAuthRefreshTokenRepositoryInterface
     */
    protected $refreshTokenRepository;

    /**
     * @var OAuthAuthCodeRepositoryInterface
     */
    protected $authCodeRepository;

    /**
     * @var CryptKey
     */
    protected $privateKey;

    /**
     * @var \DateInterval
     */
    protected $refreshTokenTTL;

    /**
     * @var string
     */
    protected $scopeDelimiter;




    /**
     * {@inheritdoc}
     */
    public function validateAuthorizationRequest($request) {
        throw new \LogicException('This grant cannot validate an authorization request.');
    }




    /**
     * {@inheritdoc}
     */
    public function completeAuthorizationRequest($authorizationRequest) {
        throw new \LogicException('This grant cannot complete an authorization request.');
    }




    /**
     * Validate the client.
     *
     * @param Request $request
     *
     * @throws BadRequestException
     * @throws OAuth2Exception
     *
     * @return OAuthClient
     */
    protected function validateClient($request) {
        // Fetching the clientId parameter
        $clientId = $request->getParsedBodyParam('client_id');

        // Checking the client id parameter
        if(Utils::isNull($clientId)) {
            throw BadRequestException::invalidParameter('client_id');
        }

        // Fetching the client secret
        $clientSecret = $request->getParsedBodyParam('client_secret');

        // Fetching the client entity
        $client = $this->clientRepository->getClient(
            $clientId,
            $clientSecret,
            $this->getId(),
            Utils::isNotNull($clientSecret)
        );

        // Checking whether the client has been successfully fetched
        if(Utils::isNull($client)) {
            throw OAuth2Exception::invalidClient();
        }

        // Returning the client
        return $client;
    }




    /**
     * Validate scopes in the request.
     *
     * @param Request $request
     * @param OAuthClient $client
     *
     * @throws BadRequestException
     * @throws OAuth2Exception
     *
     * @return OAuthScope[]
     */
    protected function validateScopes($request, $client) {
        // Fetching the scopes from the request
        $scopesStr = $request->getParsedBodyParam('scopes');

        // Checking the scopes parameter
        if(Utils::isNull($scopesStr) || Utils::isEmpty($scopesStr)) {
            throw BadRequestException::invalidParameter('scopes');
        }

        // Filtering the scopes into the list
        $scopesArr = ArrayUtils::explode($this->scopeDelimiter, $scopesStr);

        // Checking whether there duplicates
        if(ArrayUtils::hasDuplicates($scopesArr)) {
            throw BadRequestException::invalidParameter('scopes', 'The `scopes` parameter contains duplicates.');
        }

        // Array for holding successfully fetched scopes
        $scopes = array();

        foreach($scopesArr as $scopeItem) {
            // Parsing the scope
            $scope = OAuthScopeUtils::parseScope($scopeItem);

            // Checking whether the parsing has been successfully performed
            if(Utils::isNull($scope)) {
                throw BadRequestException::invalidParameter($scopeItem);
            }

            // Fetching the scope and checking whether it is allowed
            // by the client and the grant type
            $scope = $this->scopeRepository->getScopeForClient(
                $scope->getPermission(),
                $scope->getDomain(),
                $client->getId(),
                $this->getId()
            );

            // Checking whether the scope has been successfully fetched
            if(Utils::isNull($scope)) {
                throw OAuth2Exception::invalidScope($scopeItem);
            }

            // Adding the scope to the array
            $scopes[] = $scope;
        }

        // Returning successfully processed scopes
        return $scopes;
    }




    /**
     * Issue an access token.
     *
     * @param \DateInterval     $accessTokenTTL     Access token expiry time
     * @param OAuthClient            $client             The client
     * @param string|int        $ownerId            Either user's identifier or client's identifier
     * @param OAuthScope[] $scopes   An array of scopes
     *
     * @throws UniqueTokenIdentifierConstraintViolationException
     *
     * @return OAuthAccessToken
     */
    protected function issueAccessToken($accessTokenTTL, $client, $ownerId, $scopes) {
        // Access token max generation attempts
        $maxGenerationAttempts = self::MAX_TOKEN_GENERATION_ATTEMPTS;

        // Figuring out the owner type
        $ownerType = (($this->getId() === OAuthGrantTypes::CLIENT_CREDENTIALS) ? OAuthOwnerTypes::CLIENT : OAuthOwnerTypes::USER);

        // Creating an access token
        $accessToken = OAuthAccessToken::create($client, $scopes, $ownerType, $ownerId);
        $accessToken->setExpiryDateTime((new \DateTime())->add($accessTokenTTL));

        // Start the access token's identifier generation loop
        while($maxGenerationAttempts-- > 0) {
            // Setting the generated unique id
            $accessToken->setId(Utils::generateUniqueString(self::ACCESS_TOKEN_ID_LENGTH));

            try {
                // Enabling the clients to persist the access token (e.g., save it to the database)
                $this->accessTokenRepository->persistNewAccessToken($accessToken);

                // If we got so far, that means the newly generated access token has been
                // successfully persisted, so breaking from the loop
                break;
            } catch(UniqueTokenIdentifierConstraintViolationException $e) {
                if($maxGenerationAttempts === 0) {
                    throw $e;
                }
            }
        }

        // If the exception was not thrown, that means we have successfully issued
        // the access token, so returning it
        return $accessToken;
    }




    /**
     * @param OAuthAccessToken $accessToken
     *
     * @throws UniqueTokenIdentifierConstraintViolationException
     *
     * @return OAuthRefreshToken
     */
    protected function issueRefreshToken($accessToken) {
        // Refresh token max generation attempts
        $maxGenerationAttempts = self::MAX_TOKEN_GENERATION_ATTEMPTS;

        // Creating a new refresh token
        $refreshToken = OAuthRefreshToken::create($accessToken);
        $refreshToken->setExpiryDateTime((new \DateTime())->add($this->refreshTokenTTL));

        // Start the refresh token's identifier generation loop
        while($maxGenerationAttempts-- > 0) {
            $refreshToken->setId(Utils::generateUniqueString(self::REFRESH_TOKEN_ID_LENGTH));

            try {
                // Enabling the clients to persist the refresh token (e.g., save it to the database)
                $this->refreshTokenRepository->persistNewRefreshToken($refreshToken);

                // If we got so far, that means the newly generated refresh token has been
                // successfully persisted, so breaking from the loop
                break;
            } catch(UniqueTokenIdentifierConstraintViolationException $e) {
                if($maxGenerationAttempts === 0) {
                    throw $e;
                }
            }
        }

        // If the exception was not thrown, that means we have successfully issued
        // the refresh token, so returning it
        return $refreshToken;
    }




    protected function issueAuthCode() {
        // todo
    }




    /**
     * {@inheritdoc}
     */
    public function setClientRepository($clientRepository) {
        $this->clientRepository = $clientRepository;
    }




    /**
     * {@inheritdoc}
     */
    public function setAccessTokenRepository($accessTokenRepository) {
        $this->accessTokenRepository = $accessTokenRepository;
    }




    /**
     * {@inheritdoc}
     */
    public function setScopeRepository($scopeRepository) {
        $this->scopeRepository = $scopeRepository;
    }




    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function setUserRepository($userRepository) {
        $this->userRepository = $userRepository;
    }




    /**
     * @param OAuthRefreshTokenRepositoryInterface $refreshTokenRepository
     */
    public function setRefreshTokenRepository($refreshTokenRepository) {
        $this->refreshTokenRepository = $refreshTokenRepository;
    }




    /**
     * @param OAuthAuthCodeRepositoryInterface $authCodeRepository
     */
    public function setAuthCodeRepository($authCodeRepository) {
        $this->authCodeRepository = $authCodeRepository;
    }




    /**
     * {@inheritdoc}
     */
    public function setPrivateKey($privateKey) {
        $this->privateKey = $privateKey;
    }




    /**
     * @param \DateInterval $refreshTokenTTL
     */
    public function setRefreshTokenTTL($refreshTokenTTL) {
        $this->refreshTokenTTL = $refreshTokenTTL;
    }




    /**
     * {@inheritdoc}
     */
    public function setScopeDelimiter($scopeDelimiter) {
        $this->scopeDelimiter = $scopeDelimiter;
    }




    /**
     * {@inheritdoc}
     */
    public function canRespondToTokenRequest($request) {
        return ($request->getParsedBodyParam('grant_type') === $this->getId());
    }




    /**
     * {@inheritdoc}
     */
    public function canRespondToAuthorizationRequest($request) {
        return false;
    }




}