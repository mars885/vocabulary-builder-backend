<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/23/17
 * Time: 12:45 AM
 */

namespace App\Model\Constants;

abstract class OAuthScopes {


    const R_EMAIL_ID = 1;
    const R_EMAIL_PERMISSION_ID = OAuthScopePermissions::READ_ID;
    const R_EMAIL_DOMAIN_ID = OAuthScopeDomains::EMAIL_ID;
    const R_EMAIL_DESCRIPTION = 'Grants read access to user\'s email address.';

    const W_EMAIL_ID = 2;
    const W_EMAIL_PERMISSION_ID = OAuthScopePermissions::WRITE_ID;
    const W_EMAIL_DOMAIN_ID = OAuthScopeDomains::EMAIL_ID;
    const W_EMAIL_DESCRIPTION = 'Grants write access to user\'s email address.';

    const R_PASSWORD_ID = 3;
    const R_PASSWORD_PERMISSION_ID = OAuthScopePermissions::READ_ID;
    const R_PASSWORD_DOMAIN_ID = OAuthScopeDomains::PASSWORD_ID;
    const R_PASSWORD_DESCRIPTION = 'Grants read access to user\'s password.';

    const W_PASSWORD_ID = 4;
    const W_PASSWORD_PERMISSION_ID = OAuthScopePermissions::WRITE_ID;
    const W_PASSWORD_DOMAIN_ID = OAuthScopeDomains::PASSWORD_ID;
    const W_PASSWORD_DESCRIPTION = 'Grants write access to user\'s password.';

    const R_USERS_ID = 5;
    const R_USERS_PERMISSION_ID = OAuthScopePermissions::READ_ID;
    const R_USERS_DOMAIN_ID = OAuthScopeDomains::USERS_ID;
    const R_USERS_DESCRIPTION = 'Grants read access to users information.';

    const W_USERS_ID = 6;
    const W_USERS_PERMISSION_ID = OAuthScopePermissions::WRITE_ID;
    const W_USERS_DOMAIN_ID = OAuthScopeDomains::USERS_ID;
    const W_USERS_DESCRIPTION = 'Grants write access to users information.';

    const R_WORDS_ID = 7;
    const R_WORDS_PERMISSION_ID = OAuthScopePermissions::READ_ID;
    const R_WORDS_DOMAIN_ID = OAuthScopeDomains::WORDS_ID;
    const R_WORDS_DESCRIPTION = 'Grants read access to dictionary\'s words.';

    const W_WORDS_ID = 8;
    const W_WORDS_PERMISSION_ID = OAuthScopePermissions::WRITE_ID;
    const W_WORDS_DOMAIN_ID = OAuthScopeDomains::WORDS_ID;
    const W_WORDS_DESCRIPTION = 'Grants write access to dictionary\'s words.';

    const R_QUIZZES_ID = 9;
    const R_QUIZZES_PERMISSION_ID = OAuthScopePermissions::READ_ID;
    const R_QUIZZES_DOMAIN_ID = OAuthScopeDomains::QUIZZES_ID;
    const R_QUIZZES_DESCRIPTION = 'Grants read access to quizzes.';

    const W_QUIZZES_ID = 10;
    const W_QUIZZES_PERMISSION_ID = OAuthScopePermissions::WRITE_ID;
    const W_QUIZZES_DOMAIN_ID = OAuthScopeDomains::QUIZZES_ID;
    const W_QUIZZES_DESCRIPTION = 'Grants write access to quizzes.';


}