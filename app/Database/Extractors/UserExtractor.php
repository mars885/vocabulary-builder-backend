<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/30/17
 * Time: 12:02 AM
 */

namespace App\Database\Extractors;

use App\Database\Aliases\ColumnAliases;
use App\Database\Schemas\Tables\BaseTable;
use App\Database\Schemas\Tables\UsersTable;
use App\Database\Utils\CursorCommon;
use App\Model\Follower;
use App\Model\FollowerIds;
use App\Model\Followers;
use App\Model\Friend;
use App\Model\FriendIds;
use App\Model\Friends;
use App\Model\SearchedUser;
use App\Model\SearchedUsers;
use App\Model\User;
use App\Utils\Utils;

abstract class UserExtractor {




    /**
     * @param User $user
     * @param array $cursor
     */
    public static function fillOutUser($user, $cursor) {
        if(Utils::isNull($user) || Utils::isInvalid($cursor)) {
            return;
        }

        // Filling out the object with cursor data
        $user->setId(CursorCommon::getInt($cursor, UsersTable::ID));
        $user->setUserName(CursorCommon::getString($cursor, UsersTable::USER_NAME));
        $user->setFullName(CursorCommon::getString($cursor, UsersTable::FULL_NAME));
        $user->setEmail(CursorCommon::getString($cursor, UsersTable::EMAIL));
        $user->setPassword(CursorCommon::getString($cursor, UsersTable::PASSWORD));
        $user->setFriendCount(CursorCommon::getInt($cursor, UsersTable::FRIEND_COUNT));
        $user->setFollowerCount(CursorCommon::getInt($cursor, UsersTable::FOLLOWER_COUNT));
        $user->setActivated(CursorCommon::getBoolean($cursor, UsersTable::IS_ACTIVATED));
        $user->setFollowing(CursorCommon::getBoolean($cursor, ColumnAliases::IS_FOLLOWING));
        $user->setCreatedAt(CursorCommon::getString($cursor, BaseTable::CREATED_AT));
        $user->setUpdatedAt(CursorCommon::getString($cursor, BaseTable::UPDATED_AT));
    }




    /**
     * @param array $cursor
     *
     * @return User|null
     */
    public static function extractUser($cursor) {
        $users = self::extractUsers([$cursor]);
        return (Utils::isNotNull($users) ? $users[0] : null);
    }




    /**
     * @param array $cursors
     *
     * @return User[]|null
     */
    public static function extractUsers($cursors) {
        if(Utils::isInvalid($cursors)) {
            return null;
        }

        // Creating an array of User objects
        $users = array();

        foreach($cursors as $cursor) {
            $user = new User();

            // Filling out the object with data
            self::fillOutUser($user, $cursor);

            // Adding the user to the array
            $users[] = $user;
        }

        // Returning the array
        return $users;
    }




    /**
     * @param array $cursors
     *
     * @return SearchedUsers|null
     */
    public static function extractSearchedUsers($cursors) {
        if(Utils::isInvalid($cursors)) {
            return null;
        }

        // Creating a container
        $searchedUsers = new SearchedUsers();

        foreach($cursors as $cursor) {
            $searchedUser = new SearchedUser();

            // Filling out the object with data
            self::fillOutUser($searchedUser, $cursor);

            // Adding the object to the container
            $searchedUsers->addItem($searchedUser);
        }

        // Returning the container
        return $searchedUsers;
    }




    /**
     * @param array $cursors
     *
     * @return FollowerIds|null
     */
    public static function extractFollowerIds($cursors) {
        if(Utils::isInvalid($cursors)) {
            return null;
        }

        // Creating a container
        $followerIds = new FollowerIds();

        foreach($cursors as $cursor) {
            $follower = new Follower();

            // Filling out the object with data
            self::fillOutUser($follower, $cursor);

            // Adding the object to the container
            $followerIds->addItem($follower);
        }

        // Returning the container
        return $followerIds;
    }




    /**
     * @param array $cursors
     *
     * @return Followers|null
     */
    public static function extractFollowers($cursors) {
        if(Utils::isInvalid($cursors)) {
            return null;
        }

        // Creating a container
        $followers = new Followers();

        foreach($cursors as $cursor) {
            $follower = new Follower();

            // Filling out the object with data
            self::fillOutUser($follower, $cursor);

            // Adding the object to the container
            $followers->addItem($follower);
        }

        // Returning the container
        return $followers;
    }




    /**
     * @param array $cursors
     *
     * @return FriendIds|null
     */
    public static function extractFriendsIds($cursors) {
        if(Utils::isInvalid($cursors)) {
            return null;
        }

        // Creating a container
        $friendIds = new FriendIds();

        foreach($cursors as $cursor) {
            $friend = new Friend();

            // Filling out the object with data
            self::fillOutUser($friend, $cursor);

            // Adding the object to the container
            $friendIds->addItem($friend);
        }

        // Returning the container
        return $friendIds;
    }




    /**
     * @param array $cursors
     *
     * @return Friends|null
     */
    public static function extractFriends($cursors) {
        if(Utils::isInvalid($cursors)) {
            return null;
        }

        // Creating a container
        $friends = new Friends();

        foreach($cursors as $cursor) {
            $friend = new Friend();

            // Filling out the object with data
            self::fillOutUser($friend, $cursor);

            // Adding the object to the container
            $friends->addItem($friend);
        }

        // Returning the container
        return $friends;
    }




}