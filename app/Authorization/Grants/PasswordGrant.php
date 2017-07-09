<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/15/17
 * Time: 7:28 PM
 */

namespace App\Authorization\Grants;

use App\Exceptions\BadRequestException;
use App\Exceptions\OAuth2Exception;
use App\Model\Constants\OAuthGrantTypes;
use App\Model\User;
use App\Repositories\Interfaces\OAuthRefreshTokenRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Utils\StringUtils;
use App\Utils\Utils;
use Slim\Http\Request;

class PasswordGrant extends BaseGrant {




    /**
     * @param UserRepositoryInterface                   $userRepository
     * @param OAuthRefreshTokenRepositoryInterface      $refreshTokenRepository
     * @param \DateInterval                             $refreshTokenTTL
     */
    public function __construct($userRepository, $refreshTokenRepository, $refreshTokenTTL) {
        $this->setUserRepository($userRepository);
        $this->setRefreshTokenRepository($refreshTokenRepository);
        $this->setRefreshTokenTTL($refreshTokenTTL);
    }




    /**
     * @inheritdoc
     */
    public function respondToTokenRequest($request, $response, $accessTokenTTL) {
        // Validating the request
        $client = $this->validateClient($request);
        $scopes = $this->validateScopes($request, $client);
        $user = $this->validateUser($request);

        // Issuing the access token
        $accessToken = $this->issueAccessToken($accessTokenTTL, $client, $user->getId(), $scopes);
        $refreshToken = $this->issueRefreshToken($accessToken);

        // Injecting the tokens into the response
        $response->setAccessToken($accessToken);
        $response->setRefreshToken($refreshToken);

        // Returning the response
        return $response;
    }




    /**
     * @param  Request $request
     * @throws BadRequestException
     * @throws OAuth2Exception
     * @return User
     */
    protected function validateUser($request) {
        // Fetching the email
        $email = $request->getParsedBodyParam('email');

        // Checking whether the email has been successfully fetched
        if(Utils::isNull($email)) {
            throw BadRequestException::invalidParameter('email');
        } else {
            $email = StringUtils::toLowerCase($email);
        }

        // Fetching the password
        $password = $request->getParsedBodyParam('password');

        // Checking whether the password has been successfully fetched
        if(Utils::isNull($password)) {
            throw BadRequestException::invalidParameter('password');
        }

        // Fetching the user
        $user = $this->userRepository->getUserByCredentials($email, $password);

        // Checking whether the user has been successfully fetched
        if(Utils::isNull($user)) {
            throw OAuth2Exception::invalidCredentials();
        }

        return $user;
    }




    /**
     * @inheritdoc
     */
    public function getId() {
        return OAuthGrantTypes::PASSWORD;
    }




}