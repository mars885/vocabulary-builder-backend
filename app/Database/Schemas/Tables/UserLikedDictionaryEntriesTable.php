<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 11/18/17
 * Time: 8:21 PM
 */

namespace App\Database\Schemas\Tables;

abstract class UserLikedDictionaryEntriesTable extends BaseTable {


    // Table name
    const TABLE_NAME = 'user_liked_dictionary_entries';

    // Columns
    const USER_ID = 'user_id';
    const USER_ID_DATA_TYPE = 'INT(11) UNSIGNED';

    const DICTIONARY_ENTRY_ID = 'dictionary_entry_id';
    const DICTIONARY_ENTRY_ID_DATA_TYPE = 'INT(11) UNSIGNED';


}