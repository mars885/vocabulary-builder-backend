<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/19/17
 * Time: 12:35 AM
 */

namespace App\Repositories;

use App\Exceptions\OperationException;
use App\Exceptions\UniqueTokenIdentifierConstraintViolationException;
use App\Model\Parameters\OAuthRefreshTokenParameters;
use App\Repositories\Interfaces\OAuthRefreshTokenRepositoryInterface;
use Interop\Container\ContainerInterface;

class OAuthRefreshTokenRepository extends BaseRepository implements OAuthRefreshTokenRepositoryInterface {




    /**
     * @param ContainerInterface $container
     */
    public function __construct($container) {
        parent::__construct($container);
    }




    /**
     * {@inheritdoc}
     */
    public function persistNewRefreshToken($refreshToken) {
        // Creating parameters
        $parameters = new OAuthRefreshTokenParameters();
        $parameters->setId($refreshToken->getId());
        $parameters->setAccessTokenId($refreshToken->getAccessToken()->getId());
        $parameters->setExpiryTime($refreshToken->getExpiryDateTime()->getTimestamp());

        // Inserting the refresh token into the database and getting a result
        $result = $this->container->getOAuthRefreshTokenMapper()->insertRefreshToken($parameters);

        // Checking the result
        if(!$result) {
            // Throwing an exception if could not insert the refresh token
            throw UniqueTokenIdentifierConstraintViolationException::create();
        }
    }




    /**
     * {@inheritdoc}
     */
    public function revokeRefreshToken($tokenId) {
        // Creating parameters
        $parameters = new OAuthRefreshTokenParameters();
        $parameters->setId($tokenId);
        $parameters->setRevoked(true);

        // Revoking the token
        if(!$this->container->getOAuthRefreshTokenMapper()->revokeRefreshToken($parameters)) {
            // Throwing an exception if could not revoke the refresh token
            throw OperationException::refreshTokenRevocationFailed();
        }
    }




    /**
     * {@inheritdoc}
     */
    public function isRefreshTokenRevoked($tokenId) {
        // Creating parameters
        $parameters = new OAuthRefreshTokenParameters();
        $parameters->setId($tokenId);

        // Performing a query in the database
        $result = $this->container->getOAuthRefreshTokenMapper()->isRefreshTokenRevoked($parameters);

        // Returning the result
        return $result;
    }




}