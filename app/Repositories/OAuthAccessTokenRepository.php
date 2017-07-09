<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/10/17
 * Time: 1:38 AM
 */

namespace App\Repositories;

use App\Exceptions\OperationException;
use App\Exceptions\UniqueTokenIdentifierConstraintViolationException;
use App\Model\Parameters\OAuthAccessTokenParameters;
use App\Repositories\Interfaces\OAuthAccessTokenRepositoryInterface;
use Interop\Container\ContainerInterface;

class OAuthAccessTokenRepository extends BaseRepository implements OAuthAccessTokenRepositoryInterface {




    /**
     * @param ContainerInterface $container
     */
    public function __construct($container) {
        parent::__construct($container);
    }




    /**
     * {@inheritdoc}
     */
    public function persistNewAccessToken($accessToken) {
        // Creating parameters
        $parameters = new OAuthAccessTokenParameters();
        $parameters->setId($accessToken->getId());
        $parameters->setOwnerType($accessToken->getOwnerType());
        $parameters->setOwnerId($accessToken->getOwnerId());
        $parameters->setExpiryTime($accessToken->getExpiryDateTime()->getTimestamp());
        $parameters->setClientId($accessToken->getClient()->getId());

        // Inserting the access token into the database and getting a result
        $result = $this->container->getOAuthAccessTokenMapper()->insertAccessToken($parameters);

        // Checking the result
        if(!$result) {
            // Throwing an exception if could not insert the access token
            throw UniqueTokenIdentifierConstraintViolationException::create();
        }
    }




    /**
     * {@inheritdoc}
     */
    public function revokeAccessToken($tokenId) {
        // Creating parameters
        $parameters = new OAuthAccessTokenParameters();
        $parameters->setId($tokenId);
        $parameters->setRevoked(true);

        // Revoking the token
        if(!$this->container->getOAuthAccessTokenMapper()->revokeAccessToken($parameters)) {
            // Throwing an exception if could not revoke the access token
            throw OperationException::accessTokenRevocationFailed();
        }
    }




    /**
     * {@inheritdoc}
     */
    public function isAccessTokenRevoked($tokenId) {
        // Creating parameters
        $parameters = new OAuthAccessTokenParameters();
        $parameters->setId($tokenId);

        // Performing a query in the database
        $result = $this->container->getOAuthAccessTokenMapper()->isAccessTokenRevoked($parameters);

        // Returning the result
        return $result;
    }




}