<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/29/17
 * Time: 2:38 PM
 */

namespace App\Database\Queries;

use App\Database\Schemas\Procedures;
use App\Database\Schemas\Tables\FollowersTable;
use App\Database\Schemas\Tables\UserDictionaryEntriesTable;
use App\Database\Schemas\Tables\UserLikedDictionaryEntriesTable;
use App\Database\Schemas\Triggers;
use App\Model\Constants\WordCategories;

abstract class TriggerQueries {




    /**
     * @return string
     */
    public static function getAfterInsertOnUserDictionaryEntriesTriggerCreationQuery() {
        return
            'CREATE TRIGGER ' . Triggers::USER_DICTIONARY_ENTRIES_TRIGGER_AFTER_INSERT
            . ' AFTER INSERT ON ' . UserDictionaryEntriesTable::TABLE_NAME
            . ' FOR EACH ROW BEGIN '
            . 'IF NEW.' . UserDictionaryEntriesTable::WORD_CATEGORY_ID . ' != ' . WordCategories::NEW_ID . ' THEN '
            . 'IF NEW.' . UserDictionaryEntriesTable::WORD_CATEGORY_ID . ' = ' . WordCategories::LEARNING_ID . ' THEN '
            . 'call ' . Procedures::INCREMENT_DICTIONARY_ENTRY_LEARNER_COUNT_PROCEDURE_NAME . '('
            . 'NEW.' . UserDictionaryEntriesTable::DICTIONARY_ENTRY_ID . '); ELSE '
            . 'call ' . Procedures::INCREMENT_DICTIONARY_ENTRY_MASTER_COUNT_PROCEDURE_NAME . '('
            . 'NEW.' . UserDictionaryEntriesTable::DICTIONARY_ENTRY_ID . '); END IF; END IF; END;'
        ;
    }




    /**
     * @return string
     */
    public static function getAfterInsertOnUserDictionaryEntriesTriggerDeletionQuery() {
        return 'DROP TRIGGER ' . Triggers::USER_DICTIONARY_ENTRIES_TRIGGER_AFTER_INSERT;
    }




    /**
     * @return string
     */
    public static function getAfterUpdateOnUserDictionaryEntriesTriggerCreationQuery() {
        return
            'CREATE TRIGGER ' . Triggers::USER_DICTIONARY_ENTRIES_TRIGGER_AFTER_UPDATE
            . ' AFTER UPDATE ON ' . UserDictionaryEntriesTable::TABLE_NAME
            . ' FOR EACH ROW BEGIN '
            . 'IF OLD.' . UserDictionaryEntriesTable::WORD_CATEGORY_ID
            . ' != NEW.' . UserDictionaryEntriesTable::WORD_CATEGORY_ID . ' THEN '
            . 'IF OLD.' . UserDictionaryEntriesTable::WORD_CATEGORY_ID . ' = ' . WordCategories::NEW_ID . ' THEN '
            . 'IF NEW.' . UserDictionaryEntriesTable::WORD_CATEGORY_ID . ' = ' . WordCategories::LEARNING_ID . ' THEN '
            . 'call ' . Procedures::INCREMENT_DICTIONARY_ENTRY_LEARNER_COUNT_PROCEDURE_NAME . '('
            . 'OLD.' . UserDictionaryEntriesTable::DICTIONARY_ENTRY_ID . '); '
            . 'ELSEIF NEW.' . UserDictionaryEntriesTable::WORD_CATEGORY_ID . ' = ' . WordCategories::MASTERED_ID . ' THEN '
            . 'call ' . Procedures::INCREMENT_DICTIONARY_ENTRY_MASTER_COUNT_PROCEDURE_NAME . '('
            . 'OLD.' . UserDictionaryEntriesTable::DICTIONARY_ENTRY_ID . '); END IF; '
            . 'ELSEIF OLD.' . UserDictionaryEntriesTable::WORD_CATEGORY_ID . ' = ' . WordCategories::LEARNING_ID . ' THEN '
            . 'call ' . Procedures::DECREMENT_DICTIONARY_ENTRY_LEARNER_COUNT_PROCEDURE_NAME . '('
            . 'OLD.' . UserDictionaryEntriesTable::DICTIONARY_ENTRY_ID . '); '
            . 'IF NEW.' . UserDictionaryEntriesTable::WORD_CATEGORY_ID . ' = ' . WordCategories::MASTERED_ID . ' THEN '
            . 'call ' . Procedures::INCREMENT_DICTIONARY_ENTRY_MASTER_COUNT_PROCEDURE_NAME . '('
            . 'OLD.' . UserDictionaryEntriesTable::DICTIONARY_ENTRY_ID . '); END IF; '
            . 'ELSE '
            . 'call ' . Procedures::DECREMENT_DICTIONARY_ENTRY_MASTER_COUNT_PROCEDURE_NAME . '('
            . 'OLD.' . UserDictionaryEntriesTable::DICTIONARY_ENTRY_ID . '); '
            . 'IF NEW.' . UserDictionaryEntriesTable::WORD_CATEGORY_ID . ' = ' . WordCategories::LEARNING_ID . ' THEN '
            . 'call '. Procedures::INCREMENT_DICTIONARY_ENTRY_LEARNER_COUNT_PROCEDURE_NAME . '('
            . 'OLD.' . UserDictionaryEntriesTable::DICTIONARY_ENTRY_ID . '); END IF; END IF; END IF; END;'
        ;
    }




    /**
     * @return string
     */
    public static function getAfterUpdateOnUserDictionaryEntriesTriggerDeletionQuery() {
        return 'DROP TRIGGER ' . Triggers::USER_DICTIONARY_ENTRIES_TRIGGER_AFTER_UPDATE;
    }




    /**
     * @return string
     */
    public static function getAfterDeleteOnUserDictionaryEntriesTriggerCreationQuery() {
        return
            'CREATE TRIGGER ' . Triggers::USER_DICTIONARY_ENTRIES_TRIGGER_AFTER_DELETE
            . ' AFTER DELETE ON ' . UserDictionaryEntriesTable::TABLE_NAME
            . ' FOR EACH ROW BEGIN '
            . 'IF OLD.' . UserDictionaryEntriesTable::WORD_CATEGORY_ID . ' != ' . WordCategories::NEW_ID . ' THEN '
            . 'IF OLD.' . UserDictionaryEntriesTable::WORD_CATEGORY_ID . ' = ' . WordCategories::LEARNING_ID . ' THEN '
            . 'call ' . Procedures::DECREMENT_DICTIONARY_ENTRY_LEARNER_COUNT_PROCEDURE_NAME . '('
            . 'OLD.' . UserDictionaryEntriesTable::DICTIONARY_ENTRY_ID . '); ELSE '
            . 'call ' . Procedures::DECREMENT_DICTIONARY_ENTRY_MASTER_COUNT_PROCEDURE_NAME . '('
            . 'OLD.' . UserDictionaryEntriesTable::DICTIONARY_ENTRY_ID . '); END IF; END IF; END;'
        ;
    }




    /**
     * @return string
     */
    public static function getAfterDeleteOnUserDictionaryEntriesTriggerDeletionQuery() {
        return 'DROP TRIGGER ' . Triggers::USER_DICTIONARY_ENTRIES_TRIGGER_AFTER_DELETE;
    }




    /**
     * @return string
     */
    public static function getAfterInsertOnUserLikedDictionaryEntriesTriggerCreationQuery() {
        return
            'CREATE TRIGGER ' . Triggers::USER_LIKED_DICTIONARY_ENTRIES_TRIGGER_AFTER_INSERT
            . ' AFTER INSERT ON ' . UserLikedDictionaryEntriesTable::TABLE_NAME
            . ' FOR EACH ROW BEGIN '
            . 'call ' . Procedures::INCREMENT_DICTIONARY_ENTRY_LIKE_COUNT_PROCEDURE_NAME . '('
            . 'NEW.' . UserLikedDictionaryEntriesTable::DICTIONARY_ENTRY_ID . '); END;'
        ;
    }




    /**
     * @return string
     */
    public static function getAfterInsertOnUserLikedDictionaryEntriesTriggerDeletionQuery() {
        return 'DROP TRIGGER ' . Triggers::USER_LIKED_DICTIONARY_ENTRIES_TRIGGER_AFTER_INSERT;
    }




    /**
     * @return string
     */
    public static function getAfterDeleteOnUserLikedDictionaryEntriesTriggerCreationQuery() {
        return
            'CREATE TRIGGER ' . Triggers::USER_LIKED_DICTIONARY_ENTRIES_TRIGGER_AFTER_DELETE
            . ' AFTER DELETE ON ' . UserLikedDictionaryEntriesTable::TABLE_NAME
            . ' FOR EACH ROW BEGIN '
            . 'call ' . Procedures::DECREMENT_DICTIONARY_ENTRY_LIKE_COUNT_PROCEDURE_NAME . '('
            . 'OLD.' . UserLikedDictionaryEntriesTable::DICTIONARY_ENTRY_ID . '); END;'
        ;
    }




    /**
     * @return string
     */
    public static function getAfterDeleteOnUserLikedDictionaryEntriesTriggerDeletionQuery() {
        return 'DROP TRIGGER ' . Triggers::USER_LIKED_DICTIONARY_ENTRIES_TRIGGER_AFTER_DELETE;
    }




    /**
     * @return string
     */
    public static function getAfterInsertOnFollowersTriggerCreationQuery() {
        return
            'CREATE TRIGGER ' . Triggers::FOLLOWERS_TRIGGER_AFTER_INSERT
            . ' AFTER INSERT ON ' . FollowersTable::TABLE_NAME
            . ' FOR EACH ROW BEGIN '
            . 'call ' . Procedures::INCREMENT_USER_FRIEND_COUNT_PROCEDURE_NAME . '('
            . 'NEW.' . FollowersTable::FOLLOWER_ID . '); '
            . 'call ' . Procedures::INCREMENT_USER_FOLLOWER_COUNT_PROCEDURE_NAME . '('
            . 'NEW.' . FollowersTable::FRIEND_ID . '); END;'
        ;
    }




    /**
     * @return string
     */
    public static function getAfterInsertOnFollowersTriggerDeletionQuery() {
        return 'DROP TRIGGER ' . Triggers::FOLLOWERS_TRIGGER_AFTER_INSERT;
    }




    /**
     * @return string
     */
    public static function getAfterDeleteOnFollowersTriggerCreationQuery() {
        return
            'CREATE TRIGGER ' . Triggers::FOLLOWERS_TRIGGER_AFTER_DELETE
            . ' AFTER DELETE ON ' . FollowersTable::TABLE_NAME
            . ' FOR EACH ROW BEGIN '
            . 'call ' . Procedures::DECREMENT_USER_FRIEND_COUNT_PROCEDURE_NAME . '('
            . 'OLD.' . FollowersTable::FOLLOWER_ID . '); '
            . 'call ' . Procedures::DECREMENT_USER_FOLLOWER_COUNT_PROCEDURE_NAME . '('
            . 'OLD.' . FollowersTable::FRIEND_ID . '); END;'
        ;
    }




    /**
     * @return string
     */
    public static function getAfterDeleteOnFollowersTriggerDeletionQuery() {
        return 'DROP TRIGGER ' . Triggers::FOLLOWERS_TRIGGER_AFTER_DELETE;
    }




}