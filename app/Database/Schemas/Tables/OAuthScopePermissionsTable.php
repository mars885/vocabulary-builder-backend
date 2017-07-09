<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 11/26/17
 * Time: 4:33 PM
 */

namespace App\Database\Schemas\Tables;

abstract class OAuthScopePermissionsTable extends BaseTable {


    // Table name
    const TABLE_NAME = 'oauth_scope_permissions';

    // Columns
    const ID = 'id';
    const ID_DATA_TYPE = 'TINYINT UNSIGNED';

    const PERMISSION = 'permission';
    const PERMISSION_DATA_TYPE = 'CHAR(1)';


}