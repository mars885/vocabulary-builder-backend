<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 1/11/18
 * Time: 4:06 AM
 */

use App\Model\Constants\Dependencies;

$app->getContainer()[Dependencies::OAUTH_CLIENT_MAPPER] = function($container) {
    return new \App\Database\Mappers\OAuthClientMapper($container->get('pdo'));
};
$app->getContainer()[Dependencies::OAUTH_SCOPE_MAPPER] = function($container) {
    return new \App\Database\Mappers\OAuthScopeMapper($container->get('pdo'));
};
$app->getContainer()[Dependencies::OAUTH_ACCESS_TOKEN_MAPPER] = function($container) {
    return new \App\Database\Mappers\OAuthAccessTokenMapper($container->get('pdo'));
};
$app->getContainer()[Dependencies::OAUTH_REFRESH_TOKEN_MAPPER] = function($container) {
    return new \App\Database\Mappers\OAuthRefreshTokenMapper($container->get('pdo'));
};
$app->getContainer()[Dependencies::USER_MAPPER] = function($container) {
    return new \App\Database\Mappers\UserMapper($container->get('pdo'));
};
$app->getContainer()[Dependencies::WORD_MAPPER] = function($container) {
    return new \App\Database\Mappers\WordMapper($container->get('pdo'));
};
