<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/23/17
 * Time: 3:17 PM
 */

namespace App\Database\Schemas\Tables;

abstract class OAuthRefreshTokensTable extends BaseTable {


    // Table name
    const TABLE_NAME = 'oauth_refresh_tokens';

    // Columns
    const ID = 'id';
    const ID_DATA_TYPE = 'VARCHAR(40)';

    const ACCESS_TOKEN_ID = 'access_token_id';
    const ACCESS_TOKEN_ID_DATA_TYPE = 'VARCHAR(40)';

    const EXPIRE_TIME = 'expire_time';
    const EXPIRE_TIME_DATA_TYPE = 'INT(11) UNSIGNED';

    const IS_REVOKED = 'is_revoked';
    const IS_REVOKED_DATA_TYPE = 'TINYINT(1)';


}