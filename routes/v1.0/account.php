<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/30/17
 * Time: 7:58 PM
 */

use App\Middleware\OAuth\ResourceServerMiddleware;
use App\Model\Constants\OAuthScopeDomains;
use App\Model\OAuthScope;

$this->group('/account', function() {

    $this->post('/register', 'AccountController:register');

    $this->get('/activation/{token}', 'AccountController:activate');
    $this->post('/activation/email/resend', 'AccountController:resendConfirmationEmail');

    $this->post('/email/change', 'UserController:changeEmail')->add(new ResourceServerMiddleware(
        $this->getContainer()['resource_server'],
        [OAuthScope::withWrite(OAuthScopeDomains::EMAIL)]
    ));
    $this->post('/password/change', 'UserController:changePassword')->add(new ResourceServerMiddleware(
        $this->getContainer()['resource_server'],
        [OAuthScope::withWrite(OAuthScopeDomains::PASSWORD)]
    ));

});