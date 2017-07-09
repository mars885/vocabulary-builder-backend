<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/30/17
 * Time: 7:59 PM
 */

use App\Middleware\OAuth\ResourceServerMiddleware;
use App\Model\Constants\OAuthScopeDomains;
use App\Model\OAuthScope;

$this->group('/words', function () {

    $this->group('', function() {

        $this->get('/search', 'WordController:search');

        $this->get('/show', 'WordController:lookupById');

        $this->get('/lookup', 'WordController:lookupByIds');

    })->add(new ResourceServerMiddleware(
        $this->getContainer()['resource_server'],
        [OAuthScope::withRead(OAuthScopeDomains::WORDS)]
    ));

    $this->group('/learning', function() {

        $this->group('', function() {

            $this->get('/ids', 'WordController:learningWordsIds');
            $this->get('/list', 'WordController:learningWordsList');

        })->add(new ResourceServerMiddleware(
            $this->getContainer()['resource_server'],
            [OAuthScope::withRead(OAuthScopeDomains::USERS), OAuthScope::withRead(OAuthScopeDomains::WORDS)]
        ));

        $this->group('', function () {

            $this->post('/create/{id}', 'WordController:learnWordById');
            $this->post('/create', 'WordController:learnWordsByIds');

            $this->post('/destroy/{id}', 'WordController:unlearnWordById');
            $this->post('/destroy', 'WordController:unlearnWordsByIds');

        })->add(new ResourceServerMiddleware(
            $this->getContainer()['resource_server'],
            [OAuthScope::withWrite(OAuthScopeDomains::WORDS)]
        ));

    });

    $this->group('/mastered', function() {

        $this->group('', function() {

            $this->get('/ids', 'WordController:masteredWordsIds');
            $this->get('/list', 'WordController:masteredWordsList');

        })->add(new ResourceServerMiddleware(
            $this->getContainer()['resource_server'],
            [OAuthScope::withRead(OAuthScopeDomains::USERS), OAuthScope::withRead(OAuthScopeDomains::WORDS)]
        ));

        $this->group('', function () {

            $this->post('/create/{id}', 'WordController:masterWordById');
            $this->post('/create', 'WordController:masterWordsByIds');

            $this->post('/destroy/{id}', 'WordController:unmasterWordById');
            $this->post('/destroy', 'WordController:unmasterWordsByIds');

        })->add(new ResourceServerMiddleware(
            $this->getContainer()['resource_server'],
            [OAuthScope::withWrite(OAuthScopeDomains::WORDS)]
        ));

    });

    $this->get('/home-timeline', 'WordController:homeTimeline')->add(new ResourceServerMiddleware(
        $this->getContainer()['resource_server'],
        [OAuthScope::withRead(OAuthScopeDomains::USERS), OAuthScope::withRead(OAuthScopeDomains::WORDS)]
    ));

});

$this->group('/likes', function() {

    $this->group('', function() {

        $this->get('/ids', 'WordController:likedWordsIds');
        $this->get('/list', 'WordController:likedWordsList');

    })->add(new ResourceServerMiddleware(
        $this->getContainer()['resource_server'],
        [OAuthScope::withRead(OAuthScopeDomains::USERS), OAuthScope::withRead(OAuthScopeDomains::WORDS)]
    ));

    $this->group('', function () {

        $this->post('/create/{id}', 'WordController:likeWordById');
        $this->post('/create', 'WordController:likeWordsByIds');

        $this->post('/destroy/{id}', 'WordController:unlikeWordById');
        $this->post('/destroy', 'WordController:unlikeWordsByIds');

    })->add(new ResourceServerMiddleware(
        $this->getContainer()['resource_server'],
        [OAuthScope::withWrite(OAuthScopeDomains::WORDS)]
    ));

});

$this->group('/trends', function () {

    $this->get('/list', 'WordController:trendingWords');

    $this->get('/top', 'WordController:wordOfTheDay');

})->add(new ResourceServerMiddleware(
    $this->getContainer()['resource_server'],
    [OAuthScope::withRead(OAuthScopeDomains::WORDS)]
));