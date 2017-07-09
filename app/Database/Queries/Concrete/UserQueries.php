<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/29/17
 * Time: 11:32 PM
 */

namespace App\Database\Queries\Concrete;

use App\Database\Aliases\ColumnAliases;
use App\Database\Aliases\TableAliases;
use App\Database\Placeholders\UserPlaceholders;
use App\Database\Schemas\Tables\FollowersTable;
use App\Database\Schemas\Tables\UsersTable;
use App\Database\Utils\QueryUtil;
use App\Model\Parameters\UserParameters;
use App\Utils\ArrayUtils;

abstract class UserQueries {




    /**
     * @return string
     */
    public static function getUserByEmailFetchingQuery() {
        return
            'SELECT '
            . UsersTable::ID
            . ', '
            . UsersTable::PASSWORD
            . ' FROM '
            . UsersTable::TABLE_NAME
            . ' WHERE '
            . UsersTable::EMAIL
            . ' = '
            . UserPlaceholders::EMAIL
        ;
    }




    /**
     * @param UserParameters $parameters
     *
     * @return string
     */
    public static function getAuthenticatedUserFetchingQuery($parameters) {
        $query =
            'SELECT '
            . UsersTable::ID
            . ', '
            . UsersTable::USER_NAME
            . ', '
            . UsersTable::FULL_NAME
            . ', '
            . UsersTable::FRIEND_COUNT
            . ', '
            . UsersTable::FOLLOWER_COUNT
        ;

        if($parameters->isClientFirstParty()) {
            $query .=
                ', '
                . UsersTable::EMAIL
                . ', '
                . UsersTable::IS_ACTIVATED
            ;
        }

        $query .=
            ' FROM '
            . UsersTable::TABLE_NAME
            . ' WHERE '
            . UsersTable::ID
            . ' = '
            . UserPlaceholders::USER_ID
        ;

        return $query;
    }




    /**
     * @param UserParameters $parameters
     *
     * @return string
     */
    public static function getUsersSearchingQuery($parameters) {
        return
            'SELECT '
            . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::ID)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::USER_NAME)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::FULL_NAME)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::FRIEND_COUNT)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::FOLLOWER_COUNT)
            . ', IF('
            . QueryUtil::asTableAlias(TableAliases::FOLLOWERS_1, FollowersTable::FOLLOWER_ID)
            . ' IS NULL, 0, 1) '
            . QueryUtil::asAlias(ColumnAliases::IS_FOLLOWING)
            . ' FROM '
            . UsersTable::TABLE_NAME
            . ' '
            . QueryUtil::asAlias(TableAliases::USERS_1)
            . ' LEFT JOIN '
            . FollowersTable::TABLE_NAME
            . ' '
            . QueryUtil::asAlias(TableAliases::FOLLOWERS_1)
            . ' ON '
            . QueryUtil::asTableAlias(TableAliases::FOLLOWERS_1, FollowersTable::FOLLOWER_ID)
            . ' = '
            . UserPlaceholders::USER_ID
            . ' AND '
            . QueryUtil::asTableAlias(TableAliases::FOLLOWERS_1, FollowersTable::FRIEND_ID)
            . ' = '
            . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::ID)
            . ' WHERE ('
            . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::USER_NAME)
            . ' LIKE CONCAT(\'%\', '
            . UserPlaceholders::QUERY
            . ', \'%\') OR '
            . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::FULL_NAME)
            . ' LIKE CONCAT(\'%\', '
            . UserPlaceholders::QUERY
            . ', \'%\'))'
            . QueryUtil::appendUsersSearchCursorCondition($parameters->getCursorParameters())
        ;
    }




    /**
     * @return string
     */
    public static function getUserByIdFetchingQuery() {
        return
            'SELECT '
            . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::ID)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::USER_NAME)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::FULL_NAME)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::FRIEND_COUNT)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::FOLLOWER_COUNT)
            . ', IF('
            . QueryUtil::asTableAlias(TableAliases::FOLLOWERS_1, FollowersTable::FOLLOWER_ID)
            . ' IS NULL, 0, 1) '
            . QueryUtil::asAlias(ColumnAliases::IS_FOLLOWING)
            . ' FROM '
            . UsersTable::TABLE_NAME
            . ' '
            . QueryUtil::asAlias(TableAliases::USERS_1)
            . ' LEFT JOIN '
            . FollowersTable::TABLE_NAME
            . ' '
            . QueryUtil::asAlias(TableAliases::FOLLOWERS_1)
            . ' ON '
            . QueryUtil::asTableAlias(TableAliases::FOLLOWERS_1, FollowersTable::FOLLOWER_ID)
            . ' = '
            . UserPlaceholders::FOLLOWER_ID
            . ' AND '
            . QueryUtil::asTableAlias(TableAliases::FOLLOWERS_1, FollowersTable::FRIEND_ID)
            . ' = '
            . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::ID)
            . ' WHERE '
            . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::ID)
            . ' = '
            . UserPlaceholders::USER_ID
        ;
    }




    /**
     * @param UserParameters $parameters
     *
     * @return string
     */
    public static function getUsersByIdsFetchingQuery($parameters) {
        return
            'SELECT '
            . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::ID)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::USER_NAME)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::FULL_NAME)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::FRIEND_COUNT)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::FOLLOWER_COUNT)
            . ', IF('
            . QueryUtil::asTableAlias(TableAliases::FOLLOWERS_1, FollowersTable::FOLLOWER_ID)
            . ' IS NULL, 0, 1) '
            . QueryUtil::asAlias(ColumnAliases::IS_FOLLOWING)
            . ' FROM '
            . UsersTable::TABLE_NAME
            . ' '
            . QueryUtil::asAlias(TableAliases::USERS_1)
            . ' LEFT JOIN '
            . FollowersTable::TABLE_NAME
            . ' '
            . QueryUtil::asAlias(TableAliases::FOLLOWERS_1)
            . ' ON '
            . QueryUtil::asTableAlias(TableAliases::FOLLOWERS_1, FollowersTable::FOLLOWER_ID)
            . ' = '
            . UserPlaceholders::FOLLOWER_ID
            . ' AND '
            . QueryUtil::asTableAlias(TableAliases::FOLLOWERS_1, FollowersTable::FRIEND_ID)
            . ' = '
            . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::ID)
            . ' WHERE '
            . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::ID)
            . ' IN ('
            . QueryUtil::generateParameterPlaceholders(UserPlaceholders::USER_ID, ArrayUtils::getSize($parameters->getUserIds()))
            . ')'
        ;
    }




    /**
     * @return string
     */
    public static function getUserFollowingQuery() {
        return
            'INSERT IGNORE INTO '
            . FollowersTable::TABLE_NAME
            . ' ('
            . FollowersTable::FOLLOWER_ID
            . ', '
            . FollowersTable::FRIEND_ID
            . ') VALUES ('
            . UserPlaceholders::FOLLOWER_ID
            . ', '
            . UserPlaceholders::FRIEND_ID
            . ')'
        ;
    }




    /**
     * @return string
     */
    public static function getUserUnfollowingQuery() {
        return
            'DELETE FROM '
            . FollowersTable::TABLE_NAME
            . ' WHERE '
            . FollowersTable::FOLLOWER_ID
            . ' = '
            . UserPlaceholders::FOLLOWER_ID
            . ' AND '
            . FollowersTable::FRIEND_ID
            . ' = '
            . UserPlaceholders::FRIEND_ID
        ;
    }




    /**
     * @param UserParameters $parameters
     *
     * @return string
     */
    public static function getFriendsIdsFetchingQuery($parameters) {
        return
            'SELECT '
            . QueryUtil::asTableAlias(TableAliases::FOLLOWERS_1, FollowersTable::FRIEND_ID)
            . ' '
            . QueryUtil::asAlias(UsersTable::ID)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::FOLLOWERS_1, FollowersTable::CREATED_AT)
            . ' FROM '
            . FollowersTable::TABLE_NAME
            . ' '
            . QueryUtil::asAlias(TableAliases::FOLLOWERS_1)
            . ' WHERE '
            . QueryUtil::asTableAlias(TableAliases::FOLLOWERS_1, FollowersTable::FOLLOWER_ID)
            . ' = '
            . UserPlaceholders::FOLLOWER_ID
            . QueryUtil::appendFriendsCursorCondition($parameters->getCursorParameters())
        ;
    }




    /**
     * @param UserParameters $parameters
     *
     * @return string
     */
    public static function getFriendsListFetchingQuery($parameters) {
        return
            'SELECT '
            . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::ID)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::USER_NAME)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::FULL_NAME)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::FRIEND_COUNT)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::FOLLOWER_COUNT)
            . ', 1 '
            . QueryUtil::asAlias(ColumnAliases::IS_FOLLOWING)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::FOLLOWERS_1, FollowersTable::CREATED_AT)
            . ' FROM '
            . FollowersTable::TABLE_NAME
            . ' '
            . QueryUtil::asAlias(TableAliases::FOLLOWERS_1)
            . ' INNER JOIN '
            . UsersTable::TABLE_NAME
            . ' '
            . QueryUtil::asAlias(TableAliases::USERS_1)
            . ' ON '
            . QueryUtil::asTableAlias(TableAliases::FOLLOWERS_1, FollowersTable::FRIEND_ID)
            . ' = '
            . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::ID)
            . ' WHERE '
            . QueryUtil::asTableAlias(TableAliases::FOLLOWERS_1, FollowersTable::FOLLOWER_ID)
            . ' = '
            . UserPlaceholders::FOLLOWER_ID
            . QueryUtil::appendFriendsCursorCondition($parameters->getCursorParameters())
        ;
    }




    /**
     * @param UserParameters $parameters
     *
     * @return string
     */
    public static function getFollowersIdsFetchingQuery($parameters) {
        return
            'SELECT '
            . QueryUtil::asTableAlias(TableAliases::FOLLOWERS_1, FollowersTable::FOLLOWER_ID)
            . ' '
            . QueryUtil::asAlias(UsersTable::ID)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::FOLLOWERS_1, FollowersTable::CREATED_AT)
            . ' FROM '
            . FollowersTable::TABLE_NAME
            . ' '
            . QueryUtil::asAlias(TableAliases::FOLLOWERS_1)
            . ' WHERE '
            . QueryUtil::asTableAlias(TableAliases::FOLLOWERS_1, FollowersTable::FRIEND_ID)
            . ' = '
            . UserPlaceholders::FRIEND_ID
            . QueryUtil::appendFollowersCursorCondition($parameters->getCursorParameters())
        ;
    }




    /**
     * @param UserParameters $parameters
     *
     * @return string
     */
    public static function getFollowersListFetchingQuery($parameters) {
        return
            'SELECT '
            . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::ID)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::USER_NAME)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::FULL_NAME)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::FRIEND_COUNT)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::FOLLOWER_COUNT)
            . ', IF('
            . QueryUtil::asTableAlias(TableAliases::FOLLOWERS_2, FollowersTable::FOLLOWER_ID)
            . ' IS NULL, 0, 1) '
            . QueryUtil::asAlias(ColumnAliases::IS_FOLLOWING)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::FOLLOWERS_1, FollowersTable::CREATED_AT)
            . ' FROM '
            . FollowersTable::TABLE_NAME
            . ' '
            . QueryUtil::asAlias(TableAliases::FOLLOWERS_1)
            . ' INNER JOIN '
            . UsersTable::TABLE_NAME
            . ' '
            . QueryUtil::asAlias(TableAliases::USERS_1)
            . ' ON '
            . QueryUtil::asTableAlias(TableAliases::FOLLOWERS_1, FollowersTable::FOLLOWER_ID)
            . ' = '
            . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::ID)
            . ' LEFT JOIN '
            . FollowersTable::TABLE_NAME
            . ' '
            . QueryUtil::asAlias(TableAliases::FOLLOWERS_2)
            . ' ON '
            . QueryUtil::asTableAlias(TableAliases::FOLLOWERS_2, FollowersTable::FOLLOWER_ID)
            . ' = '
            . UserPlaceholders::FRIEND_ID
            . ' AND '
            . QueryUtil::asTableAlias(TableAliases::FOLLOWERS_2, FollowersTable::FRIEND_ID)
            . ' = '
            . QueryUtil::asTableAlias(TableAliases::FOLLOWERS_1, FollowersTable::FOLLOWER_ID)
            . ' WHERE '
            . QueryUtil::asTableAlias(TableAliases::FOLLOWERS_1, FollowersTable::FRIEND_ID)
            . ' = '
            . UserPlaceholders::FRIEND_ID
            . QueryUtil::appendFollowersCursorCondition($parameters->getCursorParameters())
        ;
    }




}
