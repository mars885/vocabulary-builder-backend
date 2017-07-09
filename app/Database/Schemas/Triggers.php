<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 11/6/17
 * Time: 2:37 AM
 */

namespace App\Database\Schemas;

use App\Database\Schemas\Tables\FollowersTable;
use App\Database\Schemas\Tables\UserDictionaryEntriesTable;
use App\Database\Schemas\Tables\UserLikedDictionaryEntriesTable;

abstract class Triggers {


    const USER_DICTIONARY_ENTRIES_TRIGGER_AFTER_INSERT = 'after_insert_on_' . UserDictionaryEntriesTable::TABLE_NAME;
    const USER_DICTIONARY_ENTRIES_TRIGGER_AFTER_UPDATE = 'after_update_on_' . UserDictionaryEntriesTable::TABLE_NAME;
    const USER_DICTIONARY_ENTRIES_TRIGGER_AFTER_DELETE = 'after_delete_on_' . UserDictionaryEntriesTable::TABLE_NAME;

    const USER_LIKED_DICTIONARY_ENTRIES_TRIGGER_AFTER_INSERT = 'after_insert_on_' . UserLikedDictionaryEntriesTable::TABLE_NAME;
    const USER_LIKED_DICTIONARY_ENTRIES_TRIGGER_AFTER_DELETE = 'after_delete_on_' . UserLikedDictionaryEntriesTable::TABLE_NAME;

    const FOLLOWERS_TRIGGER_AFTER_INSERT = 'after_insert_on_' . FollowersTable::TABLE_NAME;
    const FOLLOWERS_TRIGGER_AFTER_DELETE = 'after_delete_on_' . FollowersTable::TABLE_NAME;


}