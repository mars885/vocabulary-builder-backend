<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/22/17
 * Time: 8:48 PM
 */

namespace App\Database\Schemas\Tables;

abstract class OAuthClientTypesTable extends BaseTable {


    // Table name
    const TABLE_NAME = 'oauth_client_types';

    // Columns
    const ID = 'id';
    const ID_DATA_TYPE = 'TINYINT UNSIGNED';

    const TYPE = 'type';
    const TYPE_DATA_TYPE = 'VARCHAR(50)';


}