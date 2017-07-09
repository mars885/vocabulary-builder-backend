<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/15/17
 * Time: 6:34 PM
 */

namespace App\Authorization\Servers;

use App\Authorization\Encryption\CryptKey;
use App\Authorization\Validators\BearerTokenValidator;
use App\Authorization\Validators\Interfaces\ValidatorInterface;
use App\Model\OAuthScope;
use App\Repositories\Interfaces\OAuthAccessTokenRepositoryInterface;
use Slim\Http\Request;

class ResourceServer {


    /**
     * @var OAuthAccessTokenRepositoryInterface
     */
    private $accessTokenRepository;

    /**
     * @var CryptKey
     */
    private $publicKey;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var string
     */
    private $scopeDelimiter;




    /**
     * @param OAuthAccessTokenRepositoryInterface $accessTokenRepository
     * @param string $publicKeyPath
     * @param string $scopeDelimiter
     * @param ValidatorInterface|null $validator
     */
    public function __construct(
        $accessTokenRepository,
        $publicKeyPath,
        $scopeDelimiter,
        $validator = null
    ) {
        $this->accessTokenRepository = $accessTokenRepository;
        $this->publicKey = new CryptKey($publicKeyPath);
        $this->scopeDelimiter = $scopeDelimiter;
        $this->validator = $validator;
    }




    /**
     * Determines the access token validity.
     *
     * @param Request $request
     * @param OAuthScope[] $requiredScopes
     *
     * @return Request
     */
    public function validateAuthenticatedRequest($request, $requiredScopes) {
        // Delegating the responsibility to the validator
        return $this->getValidator()->validate($request, $requiredScopes);
    }




    /**
     * @return ValidatorInterface
     */
    protected function getValidator() {
        // Instantiating the validator (if necessary)
        if(($this->validator instanceof ValidatorInterface) === false) {
            $this->validator = new BearerTokenValidator($this->accessTokenRepository);
        }

        // Setting the public key
        $this->validator->setPublicKey($this->publicKey);
        // Setting the scope delimiter
        $this->validator->setScopeDelimiter($this->scopeDelimiter);

        // Returning the validator
        return $this->validator;
    }




}