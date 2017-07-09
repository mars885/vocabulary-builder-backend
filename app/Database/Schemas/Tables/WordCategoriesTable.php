<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 9/24/17
 * Time: 5:56 PM
 */

namespace App\Database\Schemas\Tables;

abstract class WordCategoriesTable extends BaseTable {


    // Table name
    const TABLE_NAME = 'word_categories';

    // Columns
    const ID = 'id';
    const ID_DATA_TYPE = 'TINYINT UNSIGNED';

    const CATEGORY = 'category';
    const CATEGORY_DATA_TYPE = 'VARCHAR(15)';


}