<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/23/17
 * Time: 3:15 PM
 */

namespace App\Database\Schemas\Tables;

abstract class OAuthAccessTokensTable extends BaseTable {


    // Table name
    const TABLE_NAME = 'oauth_access_tokens';

    // Columns
    const ID = 'id';
    const ID_DATA_TYPE = 'VARCHAR(40)';

    const CLIENT_ID = 'client_id';
    const CLIENT_ID_DATA_TYPE = 'VARCHAR(32)';

    const OWNER_TYPE_ID = 'owner_type_id';
    const OWNER_TYPE_ID_DATA_TYPE = 'TINYINT UNSIGNED';

    const OWNER_ID = 'owner_id';
    const OWNER_ID_DATA_TYPE = 'VARCHAR(32)';

    const EXPIRE_TIME = 'expire_time';
    const EXPIRE_TIME_DATA_TYPE = 'INT(11) UNSIGNED';

    const IS_REVOKED = 'is_revoked';
    const IS_REVOKED_DATA_TYPE = 'TINYINT(1)';


}