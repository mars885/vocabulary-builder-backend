<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/22/17
 * Time: 4:36 AM
 */

namespace App\Model\Constants;

abstract class OAuthGrantTypes {


    const AUTHORIZATION_CODE_ID = 1;
    const AUTHORIZATION_CODE = 'authorization_code';

    const IMPLICIT_ID = 2;
    const IMPLICIT = 'implicit';

    const PASSWORD_ID = 3;
    const PASSWORD = 'password';

    const CLIENT_CREDENTIALS_ID = 4;
    const CLIENT_CREDENTIALS = 'client_credentials';

    const REFRESH_TOKEN_ID = 5;
    const REFRESH_TOKEN = 'refresh_token';


}