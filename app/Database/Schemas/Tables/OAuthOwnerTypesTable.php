<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/23/17
 * Time: 3:14 PM
 */

namespace App\Database\Schemas\Tables;

abstract class OAuthOwnerTypesTable extends BaseTable {


    // Table name
    const TABLE_NAME = 'oauth_owner_types';

    // Columns
    const ID = 'id';
    const ID_DATA_TYPE = 'TINYINT UNSIGNED';

    const TYPE = 'type';
    const TYPE_DATA_TYPE = 'VARCHAR(15)';


}