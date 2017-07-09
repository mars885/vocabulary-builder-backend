<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/22/17
 * Time: 10:46 PM
 */

namespace App\Database\Schemas\Tables;

abstract class OAuthScopesTable extends BaseTable {


    // Table name
    const TABLE_NAME = 'oauth_scopes';

    // Columns
    const ID = 'id';
    const ID_DATA_TYPE = 'TINYINT UNSIGNED';

    const PERMISSION_ID = 'permission_id';
    const PERMISSION_ID_DATA_TYPE = 'TINYINT UNSIGNED';

    const DOMAIN_ID = 'domain_id';
    const DOMAIN_ID_DATA_TYPE = 'TINYINT UNSIGNED';

    const DESCRIPTION = 'description';
    const DESCRIPTION_DATA_TYPE = 'TEXT';


}