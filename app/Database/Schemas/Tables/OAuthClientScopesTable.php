<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/26/17
 * Time: 6:26 PM
 */

namespace App\Database\Schemas\Tables;

abstract class OAuthClientScopesTable extends BaseTable {


    // Table name
    const TABLE_NAME = 'oauth_client_scopes';

    // Columns
    const CLIENT_ID = 'client_id';
    const CLIENT_ID_DATA_TYPE = 'VARCHAR(32)';

    const SCOPE_ID = 'scope_id';
    const SCOPE_ID_DATA_TYPE = 'TINYINT UNSIGNED';


}