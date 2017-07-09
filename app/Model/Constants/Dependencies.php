<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 1/11/18
 * Time: 3:51 AM
 */

namespace App\Model\Constants;

abstract class Dependencies {


    // General
    const PDO = 'pdo';

    // Servers
    const AUTHORIZATION_SERVER = 'authorization_server';
    const RESOURCE_SERVER = 'resource_server';

    // Controllers
    const ACCOUNT_CONTROLLER = 'AccountController';
    const OAUTH2_CONTROLLER = 'OAuth2Controller';
    const USER_CONTROLLER = 'UserController';
    const WORD_CONTROLLER = 'WordController';

    // Repositories
    const OAUTH_CLIENT_REPOSITORY = 'oauth_client_repository';
    const OAUTH_SCOPE_REPOSITORY = 'oauth_scope_repository';
    const OAUTH_ACCESS_TOKEN_REPOSITORY = 'oauth_access_token_repository';
    const OAUTH_REFRESH_TOKEN_REPOSITORY = 'oauth_refresh_token_repository';
    const ACCOUNT_REPOSITORY = 'account_repository';
    const USER_REPOSITORY = 'user_repository';
    const WORD_REPOSITORY = 'word_repository';

    // Mappers
    const OAUTH_CLIENT_MAPPER = 'oauth_client_mapper';
    const OAUTH_SCOPE_MAPPER = 'oauth_scope_mapper';
    const OAUTH_ACCESS_TOKEN_MAPPER = 'oauth_access_token_mapper';
    const OAUTH_REFRESH_TOKEN_MAPPER = 'oauth_refresh_token_mapper';
    const USER_MAPPER = 'user_mapper';
    const WORD_MAPPER = 'word_mapper';

    // Handlers
    const ERROR_HANDLER = 'error_handler';
    const NOT_ALLOWED_HANDLER = 'not_allowed_handler';
    const NOT_FOUND_HANDLER = 'not_found_handler';
    const PHP_ERROR_HANDLER = 'php_error_handler';


}