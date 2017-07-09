<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 1/11/18
 * Time: 4:06 AM
 */

use App\Model\Constants\Dependencies;

$app->getContainer()[Dependencies::OAUTH_CLIENT_REPOSITORY] = function($container) {
    return new \App\Repositories\OAuthClientRepository($container);
};
$app->getContainer()[Dependencies::OAUTH_SCOPE_REPOSITORY] = function($container) {
    return new \App\Repositories\OAuthScopeRepository($container);
};
$app->getContainer()[Dependencies::OAUTH_ACCESS_TOKEN_REPOSITORY] = function($container) {
    return new \App\Repositories\OAuthAccessTokenRepository($container);
};
$app->getContainer()[Dependencies::OAUTH_REFRESH_TOKEN_REPOSITORY] = function($container) {
    return new \App\Repositories\OAuthRefreshTokenRepository($container);
};
$app->getContainer()[Dependencies::ACCOUNT_REPOSITORY] = function($container) {
    return new \App\Repositories\AccountRepository($container);
};
$app->getContainer()[Dependencies::USER_REPOSITORY] = function($container) {
    return new \App\Repositories\UserRepository($container);
};
$app->getContainer()[Dependencies::WORD_REPOSITORY] = function($container) {
    return new \App\Repositories\WordRepository($container);
};