<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/22/17
 * Time: 8:59 PM
 */

namespace App\Database\Schemas\Tables;

abstract class OAuthClientGrantTypesTable extends BaseTable {


    // Table name
    const TABLE_NAME = 'oauth_client_grant_types';

    // Columns
    const CLIENT_ID = 'client_id';
    const CLIENT_ID_DATA_TYPE = 'VARCHAR(32)';

    const GRANT_TYPE_ID = 'grant_type_id';
    const GRANT_TYPE_ID_DATA_TYPE = 'TINYINT UNSIGNED';


}