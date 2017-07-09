<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/24/17
 * Time: 2:16 AM
 */

namespace App\Authorization\Validators;

use App\Authorization\Encryption\CryptKey;
use App\Authorization\Validators\Interfaces\ValidatorInterface;
use App\Exceptions\OAuth2Exception;
use App\Model\Constants\OAuthScopePermissions;
use App\Model\Constants\RequestParameters\GeneralRequestParameters;
use App\Model\OAuthScope;
use App\Repositories\Interfaces\OAuthAccessTokenRepositoryInterface;
use App\Utils\ArrayUtils;
use App\Utils\OAuthScopeUtils;
use InvalidArgumentException;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use Lcobucci\JWT\ValidationData;
use RuntimeException;

class BearerTokenValidator implements ValidatorInterface {


    /**
     * @var OAuthAccessTokenRepositoryInterface
     */
    private $accessTokenRepository;

    /**
     * @var CryptKey
     */
    private $publicKey;

    /**
     * @var string
     */
    private $scopeDelimiter;




    /**
     * @param OAuthAccessTokenRepositoryInterface $accessTokenRepository
     */
    public function __construct($accessTokenRepository) {
        $this->accessTokenRepository = $accessTokenRepository;
    }




    /**
     * @inheritdoc
     */
    public function validate($request, $requiredScopes) {
        // Checking whether the authorization header is present
        if($request->hasHeader('Authorization') === false) {
            throw OAuth2Exception::accessDenied('Missing "Authorization" header.');
        }

        // Fetching the auth header
        $authHeader = $request->getHeader('Authorization');

        // Fetching the raw JWT token
        $jwt = trim(preg_replace('/^(?:\s+)?Bearer\s/', '', $authHeader[0]));

        try {
            // Parsing the JWT
            $token = (new Parser())->parse($jwt);

            // Verifying the JWT
            if($token->verify(new Sha256(), $this->publicKey->getKeyPath()) === false) {
                throw OAuth2Exception::accessDenied('Access token could not be verified.');
            }

            // Checking whether the access token has not expired
            $data = new ValidationData();
            $data->setCurrentTime(time());

            if($token->validate($data) === false) {
                throw OAuth2Exception::accessDenied('Access token is invalid.');
            }

            // Checking if the token has been revoked
            if($this->accessTokenRepository->isAccessTokenRevoked($token->getClaim('jti'))) {
                throw OAuth2Exception::accessDenied('Access token has been revoked.');
            }

            // Validating scopes
            $this->validateScopes(
                OAuthScopeUtils::parseScopes(ArrayUtils::explode($this->scopeDelimiter, $token->getClaim('scopes'))),
                $requiredScopes
            );

            // Adding to the request extra data
            $request = $request->withAttribute(GeneralRequestParameters::USER_ID, $token->getClaim('sub'));
            $request = $request->withAttribute(GeneralRequestParameters::IS_CLIENT_FIRST_PARTY, $token->getClaim('is_first_party'));
            
            // Returning the request with extra data
            return $request;
        } catch(InvalidArgumentException $exception) {
            // JWT could not be parsed, so throwing an exception
            throw OAuth2Exception::accessDenied($exception->getMessage());
        } catch(RuntimeException $exception) {
            // JWT could not be parsed, so throwing an exception
            throw OAuth2Exception::accessDenied('An error occurred while decoding the token to JSON.');
        }
    }




    /**
     * @param OAuthScope[] $tokenScopes
     * @param OAuthScope[] $requiredScopes
     *
     * @throws OAuth2Exception
     */
    protected function validateScopes($tokenScopes, $requiredScopes) {
        foreach($requiredScopes as $requiredScope) {
            // Flag to know whether the scope has been validated or not
            $validated = false;

            foreach($tokenScopes as $tokenScope) {
                // Verifying the domains
                if($requiredScope->getDomain() !== $tokenScope->getDomain()) {
                    continue;
                }

                // If the token has read & write permissions, no need to check the details
                if($tokenScope->getPermission() !== OAuthScopePermissions::WRITE) {
                    // Checking read permission
                    if($requiredScope->getPermission() === OAuthScopePermissions::READ) {
                        if($tokenScope->getPermission() !== OAuthScopePermissions::READ) {
                            continue;
                        }
                    }
                }

                // The scope passed all the checks
                $validated = true;
                break;
            }

            // Checking whether the scope has been validated
            if(!$validated) {
                throw OAuth2Exception::accessDenied(
                    'This request requires \'' . $requiredScope->__toString() . '\' scope, but this access token is not'
                    . ' authorized with it.'
                );
            }
        }
    }




    /**
     * @param CryptKey $publicKey
     */
    public function setPublicKey($publicKey) {
        $this->publicKey = $publicKey;
    }




    /**
     * @param string $scopeDelimiter
     */
    public function setScopeDelimiter($scopeDelimiter) {
        $this->scopeDelimiter = $scopeDelimiter;
    }




}