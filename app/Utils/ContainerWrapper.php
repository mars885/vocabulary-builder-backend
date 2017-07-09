<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/14/17
 * Time: 12:24 AM
 */

namespace App\Utils;

use App\Authorization\Servers\AuthorizationServer;
use App\Authorization\Servers\ResourceServer;
use App\Database\Mappers\Interfaces\OAuthClientMapperInterface;
use App\Database\Mappers\Interfaces\OAuthScopeMapperInterface;
use App\Database\Mappers\Interfaces\UserMapperInterface;
use App\Database\Mappers\Interfaces\WordMapperInterface;
use App\Database\Mappers\OAuthAccessTokenMapper;
use App\Database\Mappers\OAuthRefreshTokenMapper;
use App\Model\Constants\Dependencies;
use App\Repositories\Interfaces\AccountRepositoryInterface;
use App\Repositories\Interfaces\OAuthAccessTokenRepositoryInterface;
use App\Repositories\Interfaces\OAuthClientRepositoryInterface;
use App\Repositories\Interfaces\OAuthRefreshTokenRepositoryInterface;
use App\Repositories\Interfaces\OAuthScopeRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\WordRepositoryInterface;
use Interop\Container\ContainerInterface;
use PDO;

class ContainerWrapper {


    /**
     * @var ContainerInterface
     */
    private $container;




    /**
     * @param ContainerInterface $container
     */
    public function __construct($container) {
        $this->container = $container;
    }




    /**
     * @return array
     */
    public function getConfig() {
        return $this->container->get('settings');
    }




    /**
     * @return PDO
     */
    public function getPdo() {
        return $this->container->get(Dependencies::PDO);
    }




    /**
     * @return AuthorizationServer
     */
    public function getAuthorizationServer() {
        return $this->container->get(Dependencies::AUTHORIZATION_SERVER);
    }




    /**
     * @return ResourceServer
     */
    public function getResourceServer() {
        return $this->container->get(Dependencies::RESOURCE_SERVER);
    }




    /**
     * @return OAuthClientRepositoryInterface
     */
    public function getOAuthClientRepository() {
        return $this->container->get(Dependencies::OAUTH_CLIENT_REPOSITORY);
    }




    /**
     * @return OAuthScopeRepositoryInterface
     */
    public function getOAuthScopeRepository() {
        return $this->container->get(Dependencies::OAUTH_SCOPE_REPOSITORY);
    }




    /**
     * @return OAuthAccessTokenRepositoryInterface
     */
    public function getOAuthAccessTokenRepository() {
        return $this->container->get(Dependencies::OAUTH_ACCESS_TOKEN_REPOSITORY);
    }




    /**
     * @return OAuthRefreshTokenRepositoryInterface
     */
    public function getOAuthRefreshTokenRepository() {
        return $this->container->get(Dependencies::OAUTH_REFRESH_TOKEN_REPOSITORY);
    }




    /**
     * @return AccountRepositoryInterface
     */
    public function getAccountRepository() {
        return $this->container->get(Dependencies::ACCOUNT_REPOSITORY);
    }




    /**
     * @return UserRepositoryInterface
     */
    public function getUserRepository() {
        return $this->container->get(Dependencies::USER_REPOSITORY);
    }




    /**
     * @return WordRepositoryInterface
     */
    public function getWordRepository() {
        return $this->container->get(Dependencies::WORD_REPOSITORY);
    }




    /**
     * @return OAuthClientMapperInterface
     */
    public function getOAuthClientMapper() {
        return $this->container->get(Dependencies::OAUTH_CLIENT_MAPPER);
    }




    /**
     * @return OAuthScopeMapperInterface
     */
    public function getOAuthScopeMapper() {
        return $this->container->get(Dependencies::OAUTH_SCOPE_MAPPER);
    }




    /**
     * @return OAuthAccessTokenMapper
     */
    public function getOAuthAccessTokenMapper() {
        return $this->container->get(Dependencies::OAUTH_ACCESS_TOKEN_MAPPER);
    }




    /**
     * @return OAuthRefreshTokenMapper
     */
    public function getOAuthRefreshTokenMapper() {
        return $this->container->get(Dependencies::OAUTH_REFRESH_TOKEN_MAPPER);
    }




    /**
     * @return UserMapperInterface
     */
    public function getUserMapper() {
        return $this->container->get(Dependencies::USER_MAPPER);
    }




    /**
     * @return WordMapperInterface
     */
    public function getWordMapper() {
        return $this->container->get(Dependencies::WORD_MAPPER);
    }




}