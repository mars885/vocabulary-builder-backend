<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/30/17
 * Time: 7:53 PM
 */

use App\Middleware\OAuth\ResourceServerMiddleware;
use App\Model\Constants\OAuthScopeDomains;
use App\Model\OAuthScope;

$this->group('/oauth2', function() {

    $this->post('/access-token', 'OAuth2Controller:token');

    //$this->post('/authorize', 'OAuth2Controller:authorize');

    $this->get('/verify-credentials', 'OAuth2Controller:verifyCredentials')->add(new ResourceServerMiddleware(
        $this->getContainer()['resource_server'],
        [OAuthScope::withRead(OAuthScopeDomains::USERS)]
    ));

});