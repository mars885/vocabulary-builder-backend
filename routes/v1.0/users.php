<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/30/17
 * Time: 7:55 PM
 */

use App\Middleware\OAuth\ResourceServerMiddleware;
use App\Model\Constants\OAuthScopeDomains;
use App\Model\OAuthScope;

$this->group('/users', function() {

    $this->get('/search', 'UserController:search');

    $this->get('/show', 'UserController:lookupById');

    $this->get('/lookup', 'UserController:lookupByIds');

})->add(new ResourceServerMiddleware(
    $this->getContainer()['resource_server'],
    [OAuthScope::withRead(OAuthScopeDomains::USERS)]
));

$this->group('/friendships', function() {

    $this->post('/create', 'UserController:followUser');
    $this->post('/destroy', 'UserController:unfollowUser');

})->add(new ResourceServerMiddleware(
    $this->getContainer()['resource_server'],
    [OAuthScope::withWrite(OAuthScopeDomains::USERS)]
));

$this->group('/friends', function() {

    $this->get('/ids', 'UserController:friendsIds');
    $this->get('/list', 'UserController:friendsList');

})->add(new ResourceServerMiddleware(
    $this->getContainer()['resource_server'],
    [OAuthScope::withRead(OAuthScopeDomains::USERS)]
));

$this->group('/followers', function() {

    $this->get('/ids', 'UserController:followersIds');
    $this->get('/list', 'UserController:followersList');

})->add(new ResourceServerMiddleware(
    $this->getContainer()['resource_server'],
    [OAuthScope::withRead(OAuthScopeDomains::USERS)]
));