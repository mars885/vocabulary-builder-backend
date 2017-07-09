<?php

/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 9/20/17
 * Time: 6:10 PM
 */

use App\Middleware\OAuth\ResourceServerMiddleware;
use App\Model\Constants\OAuthScopeDomains;
use App\Model\OAuthScope;

$app->group('/v1.0', function() {

    // Words
    require_once __DIR__ . '/v1.0/words.php';

    // Users
    require_once __DIR__ . '/v1.0/users.php';

    // Account
    require_once __DIR__ . '/v1.0/account.php';

    // OAuth2
    require_once __DIR__ . '/v1.0/oauth2.php';

});