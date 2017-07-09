<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/29/17
 * Time: 2:37 PM
 */

namespace App\Database\Queries;

use App\Database\Schemas\Procedures;
use App\Database\Schemas\Tables\DictionaryTable;
use App\Database\Schemas\Tables\FollowersTable;
use App\Database\Schemas\Tables\UsersTable;

abstract class ProcedureQueries {




    /**
     * @return string
     */
    public static function getIncrementDictionaryEntryLearnerCountProcedureCreationQuery() {
        return
            'CREATE PROCEDURE ' . Procedures::INCREMENT_DICTIONARY_ENTRY_LEARNER_COUNT_PROCEDURE_NAME
            . ' (IN ' . Procedures::INCREMENT_DICTIONARY_ENTRY_LEARNER_COUNT_PROCEDURE_DICTIONARY_ENTRY_ID_PARAMETER_NAME
            .  ' ' . DictionaryTable::ID_DATA_TYPE . ') BEGIN '
            . 'UPDATE '
            . DictionaryTable::TABLE_NAME
            . ' SET '
            . DictionaryTable::LEARNER_COUNT
            . ' = '
            . DictionaryTable::LEARNER_COUNT
            . ' + 1 WHERE '
            . DictionaryTable::ID
            . ' = '
            . Procedures::INCREMENT_DICTIONARY_ENTRY_LEARNER_COUNT_PROCEDURE_DICTIONARY_ENTRY_ID_PARAMETER_NAME
            . '; END;'
        ;
    }




    /**
     * @return string
     */
    public static function getIncrementDictionaryEntryLearnerCountProcedureDeletionQuery() {
        return 'DROP procedure ' . Procedures::INCREMENT_DICTIONARY_ENTRY_LEARNER_COUNT_PROCEDURE_NAME;
    }




    /**
     * @return string
     */
    public static function getDecrementDictionaryEntryLearnerCountProcedureCreationQuery() {
        return
            'CREATE PROCEDURE ' . Procedures::DECREMENT_DICTIONARY_ENTRY_LEARNER_COUNT_PROCEDURE_NAME
            . ' (IN ' . Procedures::DECREMENT_DICTIONARY_ENTRY_LEARNER_COUNT_PROCEDURE_DICTIONARY_ENTRY_ID_PARAMETER_NAME
            . ' ' . DictionaryTable::ID_DATA_TYPE . ') BEGIN '
            . 'UPDATE '
            . DictionaryTable::TABLE_NAME
            . ' SET '
            . DictionaryTable::LEARNER_COUNT
            . ' = '
            . DictionaryTable::LEARNER_COUNT
            . ' - 1 WHERE '
            . DictionaryTable::ID
            . ' = '
            . Procedures::DECREMENT_DICTIONARY_ENTRY_LEARNER_COUNT_PROCEDURE_DICTIONARY_ENTRY_ID_PARAMETER_NAME
            . '; END;'
        ;
    }




    /**
     * @return string
     */
    public static function getDecrementDictionaryEntryLearnerCountProcedureDeletionQuery() {
        return 'DROP procedure ' . Procedures::DECREMENT_DICTIONARY_ENTRY_LEARNER_COUNT_PROCEDURE_NAME;
    }




    /**
     * @return string
     */
    public static function getIncrementDictionaryEntryMasterCountProcedureCreationQuery() {
        return
            'CREATE PROCEDURE ' . Procedures::INCREMENT_DICTIONARY_ENTRY_MASTER_COUNT_PROCEDURE_NAME
            . ' (IN ' . Procedures::INCREMENT_DICTIONARY_ENTRY_MASTER_COUNT_PROCEDURE_DICTIONARY_ENTRY_ID_PARAMETER_NAME
            . ' ' . DictionaryTable::ID_DATA_TYPE . ') BEGIN '
            . 'UPDATE '
            . DictionaryTable::TABLE_NAME
            . ' SET '
            . DictionaryTable::MASTER_COUNT
            . ' = '
            . DictionaryTable::MASTER_COUNT
            . ' + 1 WHERE '
            . DictionaryTable::ID
            . ' = '
            . Procedures::INCREMENT_DICTIONARY_ENTRY_MASTER_COUNT_PROCEDURE_DICTIONARY_ENTRY_ID_PARAMETER_NAME
            . '; END;'
        ;
    }




    /**
     * @return string
     */
    public static function getIncrementDictionaryEntryMasterCountProcedureDeletionQuery() {
        return 'DROP procedure ' . Procedures::INCREMENT_DICTIONARY_ENTRY_MASTER_COUNT_PROCEDURE_NAME;
    }




    /**
     * @return string
     */
    public static function getDecrementDictionaryEntryMasterCountProcedureCreationQuery() {
        return
            'CREATE PROCEDURE ' . Procedures::DECREMENT_DICTIONARY_ENTRY_MASTER_COUNT_PROCEDURE_NAME
            . ' (IN ' . Procedures::DECREMENT_DICTIONARY_ENTRY_MASTER_COUNT_PROCEDURE_DICTIONARY_ENTRY_ID_PARAMETER_NAME
            . ' ' . DictionaryTable::ID_DATA_TYPE . ') BEGIN '
            . 'UPDATE '
            . DictionaryTable::TABLE_NAME
            . ' SET '
            . DictionaryTable::MASTER_COUNT
            . ' = '
            . DictionaryTable::MASTER_COUNT
            . ' - 1 WHERE '
            . DictionaryTable::ID
            . ' = '
            . Procedures::DECREMENT_DICTIONARY_ENTRY_MASTER_COUNT_PROCEDURE_DICTIONARY_ENTRY_ID_PARAMETER_NAME
            . '; END;'
        ;
    }




    /**
     * @return string
     */
    public static function getDecrementDictionaryEntryMasterCountProcedureDeletionQuery() {
        return 'DROP procedure ' . Procedures::DECREMENT_DICTIONARY_ENTRY_MASTER_COUNT_PROCEDURE_NAME;
    }




    /**
     * @return string
     */
    public static function getIncrementDictionaryEntryLikeCountProcedureCreationQuery() {
        return
            'CREATE PROCEDURE ' . Procedures::INCREMENT_DICTIONARY_ENTRY_LIKE_COUNT_PROCEDURE_NAME
            . ' (IN ' . Procedures::INCREMENT_DICTIONARY_ENTRY_LIKE_COUNT_PROCEDURE_DICTIONARY_ENTRY_ID_PARAMETER_NAME
            . ' ' . DictionaryTable::ID_DATA_TYPE . ') BEGIN '
            . 'UPDATE '
            . DictionaryTable::TABLE_NAME
            . ' SET '
            . DictionaryTable::LIKE_COUNT
            . ' = '
            . DictionaryTable::LIKE_COUNT
            . ' + 1 WHERE '
            . DictionaryTable::ID
            . ' = '
            . Procedures::INCREMENT_DICTIONARY_ENTRY_LIKE_COUNT_PROCEDURE_DICTIONARY_ENTRY_ID_PARAMETER_NAME
            . '; END;'
        ;
    }




    /**
     * @return string
     */
    public static function getIncrementDictionaryEntryLikeCountProcedureDeletionQuery() {
        return 'DROP procedure ' . Procedures::INCREMENT_DICTIONARY_ENTRY_LIKE_COUNT_PROCEDURE_NAME;
    }




    /**
     * @return string
     */
    public static function getDecrementDictionaryEntryLikeCountProcedureCreationQuery() {
        return
            'CREATE PROCEDURE ' . Procedures::DECREMENT_DICTIONARY_ENTRY_LIKE_COUNT_PROCEDURE_NAME
            . ' (IN ' . Procedures::DECREMENT_DICTIONARY_ENTRY_LIKE_COUNT_PROCEDURE_DICTIONARY_ENTRY_ID_PARAMETER_NAME
            . ' ' . DictionaryTable::ID_DATA_TYPE . ') BEGIN '
            . 'UPDATE '
            . DictionaryTable::TABLE_NAME
            . ' SET '
            . DictionaryTable::LIKE_COUNT
            . ' = '
            . DictionaryTable::LIKE_COUNT
            . ' - 1 WHERE '
            . DictionaryTable::ID
            . ' = '
            . Procedures::DECREMENT_DICTIONARY_ENTRY_LIKE_COUNT_PROCEDURE_DICTIONARY_ENTRY_ID_PARAMETER_NAME
            . '; END;'
        ;
    }




    /**
     * @return string
     */
    public static function getDecrementDictionaryEntryLikeCountProcedureDeletionQuery() {
        return 'DROP procedure ' . Procedures::DECREMENT_DICTIONARY_ENTRY_LIKE_COUNT_PROCEDURE_NAME;
    }




    /**
     * @return string
     */
    public static function getIncrementUserFriendCountCreationQuery() {
        return
            'CREATE PROCEDURE ' . Procedures::INCREMENT_USER_FRIEND_COUNT_PROCEDURE_NAME
            . ' (IN ' . Procedures::INCREMENT_USER_FRIEND_COUNT_PROCEDURE_USER_ID_PARAMETER_NAME
            . ' ' . FollowersTable::FRIEND_ID_DATA_TYPE . ') BEGIN '
            . 'UPDATE '
            . UsersTable::TABLE_NAME
            . ' SET '
            . UsersTable::FRIEND_COUNT
            . ' = '
            . UsersTable::FRIEND_COUNT
            . ' + 1 WHERE '
            . UsersTable::ID
            . ' = '
            . Procedures::INCREMENT_USER_FRIEND_COUNT_PROCEDURE_USER_ID_PARAMETER_NAME
            . '; END;'
        ;
    }




    /**
     * @return string
     */
    public static function getIncrementUserFriendCountDeletionQuery() {
        return 'DROP procedure ' . Procedures::INCREMENT_USER_FRIEND_COUNT_PROCEDURE_NAME;
    }




    /**
     * @return string
     */
    public static function getDecrementUserFriendCountCreationQuery() {
        return
            'CREATE PROCEDURE ' . Procedures::DECREMENT_USER_FRIEND_COUNT_PROCEDURE_NAME
            . ' (IN ' . Procedures::DECREMENT_USER_FRIEND_COUNT_PROCEDURE_USER_ID_PARAMETER_NAME
            . ' ' . FollowersTable::FRIEND_ID_DATA_TYPE . ') BEGIN '
            . 'UPDATE '
            . UsersTable::TABLE_NAME
            . ' SET '
            . UsersTable::FRIEND_COUNT
            . ' = '
            . UsersTable::FRIEND_COUNT
            . ' - 1 WHERE '
            . UsersTable::ID
            . ' = '
            . Procedures::DECREMENT_USER_FRIEND_COUNT_PROCEDURE_USER_ID_PARAMETER_NAME
            . '; END;'
        ;
    }




    /**
     * @return string
     */
    public static function getDecrementUserFriendCountDeletionQuery() {
        return 'DROP procedure ' . Procedures::DECREMENT_USER_FRIEND_COUNT_PROCEDURE_NAME;
    }




    /**
     * @return string
     */
    public static function getIncrementUserFollowerCountCreationQuery() {
        return
            'CREATE PROCEDURE ' . Procedures::INCREMENT_USER_FOLLOWER_COUNT_PROCEDURE_NAME
            . ' (IN ' . Procedures::INCREMENT_USER_FOLLOWER_COUNT_PROCEDURE_USER_ID_PARAMETER_NAME
            . ' ' . FollowersTable::FOLLOWER_ID_DATA_TYPE . ') BEGIN '
            . 'UPDATE '
            . UsersTable::TABLE_NAME
            . ' SET '
            . UsersTable::FOLLOWER_COUNT
            . ' = '
            . UsersTable::FOLLOWER_COUNT
            . ' + 1 WHERE '
            . UsersTable::ID
            . ' = '
            . Procedures::INCREMENT_USER_FOLLOWER_COUNT_PROCEDURE_USER_ID_PARAMETER_NAME
            . '; END;'
        ;
    }




    /**
     * @return string
     */
    public static function getIncrementUserFollowerCountDeletionQuery() {
        return 'DROP procedure ' . Procedures::INCREMENT_USER_FOLLOWER_COUNT_PROCEDURE_NAME;
    }




    /**
     * @return string
     */
    public static function getDecrementUserFollowerCountCreationQuery() {
        return
            'CREATE PROCEDURE ' . Procedures::DECREMENT_USER_FOLLOWER_COUNT_PROCEDURE_NAME
            . ' (IN ' . Procedures::DECREMENT_USER_FOLLOWER_COUNT_PROCEDURE_USER_ID_PARAMETER_NAME
            . ' ' . FollowersTable::FOLLOWER_ID_DATA_TYPE . ') BEGIN '
            . 'UPDATE '
            . UsersTable::TABLE_NAME
            . ' SET '
            . UsersTable::FOLLOWER_COUNT
            . ' = '
            . UsersTable::FOLLOWER_COUNT
            . ' - 1 WHERE '
            . UsersTable::ID
            . ' = '
            . Procedures::DECREMENT_USER_FOLLOWER_COUNT_PROCEDURE_USER_ID_PARAMETER_NAME
            . '; END;'
        ;
    }




    /**
     * @return string
     */
    public static function getDecrementUserFollowerCountDeletionQuery() {
        return 'DROP procedure ' . Procedures::DECREMENT_USER_FOLLOWER_COUNT_PROCEDURE_NAME;
    }




}