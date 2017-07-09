<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 1/11/18
 * Time: 4:05 AM
 */

use App\Model\Constants\Dependencies;

$app->getContainer()[Dependencies::ERROR_HANDLER] = function($container) {
    return new \App\Handlers\ErrorHandler($container['settings']['displayErrorDetails']);
};
$app->getContainer()[Dependencies::NOT_ALLOWED_HANDLER] = function() {
    return new \App\Handlers\NotAllowedHandler();
};
$app->getContainer()[Dependencies::NOT_FOUND_HANDLER] = function() {
    return new \App\Handlers\NotFoundHandler();
};
$app->getContainer()[Dependencies::PHP_ERROR_HANDLER] = function($container) {
    return new \App\Handlers\PhpErrorHandler($container['settings']['displayErrorDetails']);
};