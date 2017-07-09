<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 1/11/18
 * Time: 4:05 AM
 */

use App\Model\Constants\Dependencies;

$app->getContainer()[Dependencies::ACCOUNT_CONTROLLER] = function($container) {
    return new \App\Controllers\AccountController($container);
};
$app->getContainer()[Dependencies::OAUTH2_CONTROLLER] = function($container) {
    return new \App\Controllers\OAuth2Controller($container);
};
$app->getContainer()[Dependencies::USER_CONTROLLER] = function($container) {
    return new \App\Controllers\UserController($container);
};
$app->getContainer()[Dependencies::WORD_CONTROLLER] = function($container) {
    return new \App\Controllers\WordController($container);
};