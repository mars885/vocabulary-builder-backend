<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/25/17
 * Time: 1:22 AM
 */

namespace App\Database\Mappers;

use App\Database\Binders\CursorBinder;
use App\Database\Binders\UserBinder;
use App\Database\Extractors\UserExtractor;
use App\Database\Mappers\Interfaces\UserMapperInterface;
use App\Database\Queries\Concrete\UserQueries;
use App\Model\Cursor;
use PDO;

class UserMapper extends BaseMapper implements UserMapperInterface {




    /**
     * @param PDO $handler
     */
    public function __construct(PDO $handler) {
        parent::__construct($handler);
    }




    /**
     * @inheritdoc
     */
    public function getUserByEmail($parameters) {
        // Preparing the statement to be executed
        $statement = $this->prepareQuery(UserQueries::getUserByEmailFetchingQuery());

        // Binding the parameters
        UserBinder::bindEmailParameter($statement, $parameters->getEmail());

        // Executing the prepared statement
        if(!$this->executeStatement($statement)) {
            return null;
        }

        // Extracting a user and returning him
        return UserExtractor::extractUser($statement->fetch());
    }




    /**
     * @inheritdoc
     */
    public function getAuthenticatedUser($parameters) {
        // Preparing the statement to be executed
        $statement = $this->prepareQuery(UserQueries::getAuthenticatedUserFetchingQuery($parameters));

        // Binding the parameters
        UserBinder::bindUserIdParameter($statement, $parameters->getAuthUserId());

        // Executing the prepared statement
        if(!$this->executeStatement($statement)) {
            return null;
        }

        // Extracting a user and returning him
        return UserExtractor::extractUser($statement->fetch());
    }




    /**
     * @inheritdoc
     */
    public function search($parameters) {
        // Preparing the statement to be executed
        $statement = $this->prepareQuery(UserQueries::getUsersSearchingQuery($parameters));

        // Binding all the possible parameters
        UserBinder::bindUserIdParameter($statement, $parameters->getAuthUserId());
        UserBinder::bindQueryParameter($statement, $parameters->getQuery());
        CursorBinder::bindIdParameter($statement, $parameters->getCursorParameters()->getParameter(Cursor::COLUMN_ID));
        CursorBinder::bindFollowerCountParameter($statement, $parameters->getCursorParameters()->getParameter(Cursor::COLUMN_FOLLOWER_COUNT));
        CursorBinder::bindLimitParameter($statement, $parameters->getCursorParameters()->getLimitAdjustedForDatabase());

        // Executing the prepared statement
        if(!$this->executeStatement($statement)) {
            return null;
        }

        // Extracting searched users and returning them
        return UserExtractor::extractSearchedUsers($statement->fetchAll());
    }




    /**
     * @inheritdoc
     */
    public function lookupById($parameters) {
        // Preparing the statement to be executed
        $statement = $this->prepareQuery(UserQueries::getUserByIdFetchingQuery());

        // Binding the parameters
        UserBinder::bindFollowerIdParameter($statement, $parameters->getAuthUserId());
        UserBinder::bindUserIdParameter($statement, $parameters->getUserId());

        // Executing the prepared statement
        if(!$this->executeStatement($statement)) {
            return null;
        }

        // Extracting a user and returning him
        return UserExtractor::extractUser($statement->fetch());
    }




    /**
     * @inheritdoc
     */
    public function lookupByIds($parameters) {
        // Preparing the statement to be executed
        $statement = $this->prepareQuery(UserQueries::getUsersByIdsFetchingQuery($parameters));

        // Binding the parameters
        UserBinder::bindFollowerIdParameter($statement, $parameters->getAuthUserId());
        UserBinder::bindUserIdsParameter($statement, $parameters->getUserIds());

        // Executing the prepared statement
        if(!$this->executeStatement($statement)) {
            return null;
        }

        // Extracting users and returning them
        return UserExtractor::extractUsers($statement->fetchAll());
    }




    /**
     * @inheritdoc
     */
    public function followUser($parameters) {
        // Preparing the statement to be executed
        $statement = $this->prepareQuery(UserQueries::getUserFollowingQuery());

        // Binding the parameters
        UserBinder::bindFollowerIdParameter($statement, $parameters->getAuthUserId());
        UserBinder::bindFriendIdParameter($statement, $parameters->getUserId());

        // Executing the prepared statement
        return $this->executeStatement($statement);
    }




    /**
     * @inheritdoc
     */
    public function unfollowUser($parameters) {
        // Preparing the statement to be executed
        $statement = $this->prepareQuery(UserQueries::getUserUnfollowingQuery());

        // Binding the parameters
        UserBinder::bindFollowerIdParameter($statement, $parameters->getAuthUserId());
        UserBinder::bindFriendIdParameter($statement, $parameters->getUserId());

        // Executing the prepared statement
        return $this->executeStatement($statement);
    }




    /**
     * @inheritdoc
     */
    public function getFriendsIds($parameters) {
        // Preparing the statement to be executed
        $statement = $this->prepareQuery(UserQueries::getFriendsIdsFetchingQuery($parameters));

        // Binding all the possible parameters
        UserBinder::bindFollowerIdParameter($statement, $parameters->getUserId());
        CursorBinder::bindCreatedAtParameter($statement, $parameters->getCursorParameters()->getParameter(Cursor::COLUMN_CREATED_AT));
        CursorBinder::bindLimitParameter($statement, $parameters->getCursorParameters()->getLimitAdjustedForDatabase());

        // Executing the prepared statement
        if(!$this->executeStatement($statement)) {
            return null;
        }

        // Extracting friends ids and returning them
        return UserExtractor::extractFriendsIds($statement->fetchAll());
    }




    /**
     * @inheritdoc
     */
    public function getFriendsList($parameters) {
        // Preparing the statement to be executed
        $statement = $this->prepareQuery(UserQueries::getFriendsListFetchingQuery($parameters));

        // Binding all the the possible parameters
        UserBinder::bindFollowerIdParameter($statement, $parameters->getUserId());
        CursorBinder::bindCreatedAtParameter($statement, $parameters->getCursorParameters()->getParameter(Cursor::COLUMN_CREATED_AT));
        CursorBinder::bindLimitParameter($statement, $parameters->getCursorParameters()->getLimitAdjustedForDatabase());

        // Executing the prepared statement
        if(!$this->executeStatement($statement)) {
            return null;
        }

        // Extracting friends and returning them
        return UserExtractor::extractFriends($statement->fetchAll());
    }




    /**
     * @inheritdoc
     */
    public function getFollowersIds($parameters) {
        // Preparing the statement to be executed
        $statement = $this->prepareQuery(UserQueries::getFollowersIdsFetchingQuery($parameters));

        // Binding all the possible parameters
        UserBinder::bindFriendIdParameter($statement, $parameters->getUserId());
        CursorBinder::bindCreatedAtParameter($statement, $parameters->getCursorParameters()->getParameter(Cursor::COLUMN_CREATED_AT));
        CursorBinder::bindLimitParameter($statement, $parameters->getCursorParameters()->getLimitAdjustedForDatabase());

        // Executing the prepared statement
        if(!$this->executeStatement($statement)) {
            return null;
        }

        // Extracting followers ids and returning them
        return UserExtractor::extractFollowerIds($statement->fetchAll());
    }




    /**
     * @inheritdoc
     */
    public function getFollowersList($parameters) {
        // Preparing the statement to be executed
        $statement = $this->prepareQuery(UserQueries::getFollowersListFetchingQuery($parameters));

        // Binding all the the possible parameters
        UserBinder::bindFriendIdParameter($statement, $parameters->getUserId());
        CursorBinder::bindCreatedAtParameter($statement, $parameters->getCursorParameters()->getParameter(Cursor::COLUMN_CREATED_AT));
        CursorBinder::bindLimitParameter($statement, $parameters->getCursorParameters()->getLimitAdjustedForDatabase());

        // Executing the prepared statement
        if(!$this->executeStatement($statement)) {
            return null;
        }

        // Extracting followers and returning them
        return UserExtractor::extractFollowers($statement->fetchAll());
    }




}