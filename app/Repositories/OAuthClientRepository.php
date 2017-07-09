<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/10/17
 * Time: 1:37 AM
 */

namespace App\Repositories;

use App\Model\Constants\OAuthGrantTypes;
use App\Model\Parameters\OAuthClientParameters;
use App\Repositories\Interfaces\OAuthClientRepositoryInterface;
use App\Utils\Utils;
use Interop\Container\ContainerInterface;

class OAuthClientRepository extends BaseRepository implements OAuthClientRepositoryInterface {




    /**
     * @param ContainerInterface $container
     */
    public function __construct($container) {
        parent::__construct($container);
    }




    /**
     * {@inheritdoc}
     */
    public function getClient($clientId, $clientSecret, $grantType, $mustValidateSecret) {
        // Creating parameters
        $parameters = new OAuthClientParameters();
        $parameters->setClientId($clientId);
        $parameters->setGrantType($grantType);

        // Fetching the client from the database
        $client = $this->container->getOAuthClientMapper()->getClientByIdAndGrantType($parameters);

        // Checking whether the client has been successfully fetched
        if(Utils::isNull($client)) {
            return null;
        }

        // Checking the secret (if necessary)
        if($mustValidateSecret && ($client->getSecret() !== $clientSecret)) {
            return null;
        }

        // Checking the grant type and isFirstParty flag to deny
        // access to the third-party applications
        if(($grantType === OAuthGrantTypes::PASSWORD) && !$client->isFirstParty()) {
            return null;
        }

        // Returning it
        return $client;
    }




}