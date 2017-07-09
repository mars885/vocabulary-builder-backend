<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 11/10/17
 * Time: 10:20 PM
 */

namespace App\Database\Schemas\Tables;

abstract class BaseTable {


    // Columns
    const CREATED_AT = 'created_at';
    const CREATED_AT_DATA_TYPE = 'TIMESTAMP';

    const UPDATED_AT = 'updated_at';
    const UPDATED_AT_DATA_TYPE = 'TIMESTAMP';

    // Referential actions
    const DELETE_REFERENTIAL_ACTION = 'RESTRICT';
    const UPDATE_REFERENTIAL_ACTION = 'CASCADE';

    // Meta
    const ENGINE = 'InnoDB';
    const CHARACTER_SET = 'utf8';
    const COLLATION = 'utf8_general_ci';


}