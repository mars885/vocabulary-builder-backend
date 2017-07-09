<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 1/11/18
 * Time: 4:06 AM
 */

use App\Model\Constants\Dependencies;

$app->getContainer()[Dependencies::AUTHORIZATION_SERVER] = function($container) {
    // Fetching the keys
    $keys = $container['settings']['keys'];
    // Fetching the oauth configuration
    $oauth2 = $container['settings']['oauth2'];
    // Fetching the tokens times to live (TTL)
    $tokensTTL = $oauth2['ttl'];

    // Repositories
    $clientRepository = $container->get(Dependencies::OAUTH_CLIENT_REPOSITORY);
    $accessTokenRepository = $container->get(Dependencies::OAUTH_ACCESS_TOKEN_REPOSITORY);
    $refreshTokenRepository = $container->get(Dependencies::OAUTH_REFRESH_TOKEN_REPOSITORY);
    $scopeRepository = $container->get(Dependencies::OAUTH_SCOPE_REPOSITORY);
    $userRepository = $container->get(Dependencies::USER_REPOSITORY);

    // Instantiating an authorization server
    $server = new \App\Authorization\Servers\AuthorizationServer(
        $clientRepository,
        $accessTokenRepository,
        $scopeRepository,
        $keys['private'],
        $keys['encryption'],
        $oauth2['scope_delimiter']
    );

    // Creating the password grant
    $grant = new \App\Authorization\Grants\PasswordGrant(
        $userRepository,
        $refreshTokenRepository,
        new \DateInterval($tokensTTL['refresh'])
    );
    // Enabling the password grant
    $server->enableGrantType($grant, new \DateInterval($tokensTTL['access']));

    // Creating the refresh token grant
    $grant = new \App\Authorization\Grants\RefreshTokenGrant(
        $refreshTokenRepository,
        new \DateInterval($tokensTTL['refresh'])
    );
    // Enabling the refresh token credentials grant
    $server->enableGrantType($grant, new \DateInterval($tokensTTL['access']));

    return $server;
};
$app->getContainer()[Dependencies::RESOURCE_SERVER] = function($container) {
    // Keys
    $keys = $container['settings']['keys'];

    // Repositories
    $accessTokenRepository = $container->get(Dependencies::OAUTH_ACCESS_TOKEN_REPOSITORY);

    return new \App\Authorization\Servers\ResourceServer(
        $accessTokenRepository,
        $keys['public'],
        $container['settings']['oauth2']['scope_delimiter']
    );
};