<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/10/17
 * Time: 1:38 AM
 */

namespace App\Repositories;

use App\Model\Parameters\OAuthScopeParameters;
use App\Repositories\Interfaces\OAuthScopeRepositoryInterface;
use Interop\Container\ContainerInterface;

class OAuthScopeRepository extends BaseRepository implements OAuthScopeRepositoryInterface {




    /**
     * @param ContainerInterface $container
     */
    public function __construct($container) {
        parent::__construct($container);
    }




    /**
     * {@inheritdoc}
     */
    public function getScopeForClient($permission, $domain, $clientId, $grantType) {
        // Creating parameters
        $parameters = new OAuthScopeParameters();
        $parameters->setPermission($permission);
        $parameters->setDomain($domain);
        $parameters->setClientId($clientId);
        $parameters->setGrantType($grantType);

        // Fetching the scope from the database
        $scope = $this->container->getOAuthScopeMapper()->getScopeForClient($parameters);

        // Returning it
        return $scope;
    }




}