<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/22/17
 * Time: 8:59 PM
 */

namespace App\Database\Schemas\Tables;

abstract class OAuthGrantTypesTable extends BaseTable {


    // Table name
    const TABLE_NAME = 'oauth_grant_types';

    // Columns
    const ID = 'id';
    const ID_DATA_TYPE = 'TINYINT UNSIGNED';

    const TYPE = 'type';
    const TYPE_DATA_TYPE = 'VARCHAR(25)';


}