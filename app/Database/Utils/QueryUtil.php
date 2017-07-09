<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 8/24/17
 * Time: 2:29 AM
 */

namespace App\Database\Utils;

use App\Database\Aliases\TableAliases;
use App\Database\Placeholders\CursorPlaceholders;
use App\Database\Placeholders\UserPlaceholders;
use App\Database\Schemas\Tables\BaseTable;
use App\Database\Schemas\Tables\FollowersTable;
use App\Database\Schemas\Tables\UsersTable;
use App\Model\Parameters\CursorParameters;

abstract class QueryUtil {




    /**
     * @param string $alias
     *
     * @return string
     */
    public static function asAlias($alias) {
        return ('AS ' . $alias);
    }




    /**
     * @param string $table
     * @param string $alias
     *
     * @return string
     */
    public static function asTableAlias($table, $alias) {
        return ($table . '.' . $alias);
    }




    /**
     * @param string $parameterName
     * @param int $count
     *
     * @return string
     */
    public static function generateParameterPlaceholders($parameterName, $count) {
        $str = '';
        $lastIndex = ($count - 1);

        for($i = 0; $i < $count; $i++) {
            $str .= ($parameterName . $i);

            if($i !== $lastIndex) {
                $str .= ', ';
            }
        }

        return $str;
    }




    /**
     * @return string
     */
    public static function appendTableTimestampColumns() {
        return
            BaseTable::CREATED_AT . ' ' . BaseTable::CREATED_AT_DATA_TYPE . ' NOT NULL DEFAULT CURRENT_TIMESTAMP, '
            . BaseTable::UPDATED_AT . ' ' . BaseTable::UPDATED_AT_DATA_TYPE . ' NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ;
    }




    /**
     * @return string
     */
    public static function appendTableMetaInfo() {
        return
            'ENGINE = ' . BaseTable::ENGINE
            . ' CHARACTER SET ' . BaseTable::CHARACTER_SET
            . ' COLLATE ' . BaseTable::COLLATION
        ;
    }




    /**
     * @return string
     */
    public static function appendForeignKeyReferentialActions() {
        return
            'ON DELETE ' . BaseTable::DELETE_REFERENTIAL_ACTION
            . ' ON UPDATE ' . BaseTable::UPDATE_REFERENTIAL_ACTION
        ;
    }




    /**
     * @param CursorParameters $parameters
     *
     * @return string
     */
    public static function appendUsersSearchCursorCondition($parameters) {
        if($parameters->hasCursor()) {
            $query =
                ' AND ('
                . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::FOLLOWER_COUNT)
                . ' '
                . ($parameters->hasNextCursor() ? '<' : '>')
                . ' '
                . CursorPlaceholders::FOLLOWER_COUNT
                . ' OR ('
                . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::FOLLOWER_COUNT)
                . ' = '
                . CursorPlaceholders::FOLLOWER_COUNT
                . ' AND '
                . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::ID)
                . ' '
                . ($parameters->hasNextCursor() ? '>' : '<')
                . ' '
                . CursorPlaceholders::ID
                . ')) ORDER BY '
                . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::FOLLOWER_COUNT)
                . ' '
                . ($parameters->hasNextCursor() ? 'DESC' : 'ASC')
                . ', '
                . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::ID)
                . ' '
                . ($parameters->hasNextCursor() ? 'ASC' : 'DESC')
            ;
        } else {
            $query =
                ' ORDER BY '
                . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::FOLLOWER_COUNT)
                . ' DESC, '
                . QueryUtil::asTableAlias(TableAliases::USERS_1, UsersTable::ID)
                . ' ASC'
            ;
        }

        $query .= (' LIMIT ' . CursorPlaceholders::LIMIT);

        return $query;
    }




    /**
     * @param CursorParameters $parameters
     *
     * @return string
     */
    public static function appendFriendsCursorCondition($parameters) {
        return self::appendFriendsAndFollowersCursorCondition($parameters);
    }




    /**
     * @param CursorParameters $parameters
     *
     * @return string
     */
    public static function appendFollowersCursorCondition($parameters) {
        return self::appendFriendsAndFollowersCursorCondition($parameters);
    }




    /**
     * @param CursorParameters $parameters
     *
     * @return string
     */
    public static function appendFriendsAndFollowersCursorCondition($parameters) {
        if($parameters->hasCursor()) {
            $query =
                ' AND '
                . QueryUtil::asTableAlias(TableAliases::FOLLOWERS_1, FollowersTable::CREATED_AT)
                . ' '
                . ($parameters->hasNextCursor() ? '<' : '>')
                . ' '
                . CursorPlaceholders::CREATED_AT
                . ' ORDER BY '
                . QueryUtil::asTableAlias(TableAliases::FOLLOWERS_1, FollowersTable::CREATED_AT)
                . ' '
                . ($parameters->hasNextCursor() ? 'DESC' : 'ASC')
            ;
        } else {
            $query =
                ' ORDER BY '
                . QueryUtil::asTableAlias(TableAliases::FOLLOWERS_1, FollowersTable::CREATED_AT)
                . ' DESC'
            ;
        }

        $query .= (' LIMIT ' . CursorPlaceholders::LIMIT);

        return $query;
    }




}