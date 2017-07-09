<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/23/17
 * Time: 4:28 AM
 */

namespace App\Database\Schemas\Tables;

abstract class OAuthGrantTypeScopesTable extends BaseTable {


    // Table name
    const TABLE_NAME = 'oauth_grant_type_scopes';

    // Columns
    const GRANT_TYPE_ID = 'grant_type_id';
    const GRANT_TYPE_ID_DATA_TYPE = 'TINYINT UNSIGNED';

    const SCOPE_ID = 'scope_id';
    const SCOPE_ID_DATA_TYPE = 'TINYINT UNSIGNED';


}