<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 9/24/17
 * Time: 5:58 PM
 */

namespace App\Database\Schemas\Tables;

abstract class UserDictionaryEntriesTable extends BaseTable {


    // Table name
    const TABLE_NAME = 'user_dictionary_entries';

    // Columns
    const USER_ID = 'user_id';
    const USER_ID_DATA_TYPE = 'INT(11) UNSIGNED';

    const DICTIONARY_ENTRY_ID = 'dictionary_entry_id';
    const DICTIONARY_ENTRY_ID_DATA_TYPE = 'INT(11) UNSIGNED';

    const WORD_CATEGORY_ID = 'word_category_id';
    const WORD_CATEGORY_ID_DATA_TYPE = 'TINYINT UNSIGNED';


}