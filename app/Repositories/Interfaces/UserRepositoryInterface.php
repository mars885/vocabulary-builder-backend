<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 11/2/17
 * Time: 2:34 PM
 */

namespace App\Repositories\Interfaces;

use App\Model\FollowerIds;
use App\Model\Followers;
use App\Model\FriendIds;
use App\Model\Friends;
use App\Model\Parameters\UserParameters;
use App\Model\SearchedUsers;
use App\Model\User;

interface UserRepositoryInterface {


    /**
     * @param string $email The user's email
     * @param string $password The user's password
     *
     * @return User|null
     */
    public function getUserByCredentials($email, $password);


    /**
     * @param UserParameters $parameters
     *
     * @return User|null
     */
    public function getAuthenticatedUser($parameters);


    /**
     * @param UserParameters $parameters
     *
     * @return SearchedUsers|null
     */
    public function search($parameters);


    /**
     * @param UserParameters $parameters
     *
     * @return User|null
     */
    public function lookupById($parameters);


    /**
     * @param UserParameters $parameters
     *
     * @return User[]|null
     */
    public function lookupByIds($parameters);


    /**
     * @param UserParameters $parameters
     *
     * @return bool
     */
    public function followUser($parameters);


    /**
     * @param UserParameters $parameters
     *
     * @return bool
     */
    public function unfollowUser($parameters);


    /**
     * @param UserParameters $parameters
     *
     * @return FollowerIds|null
     */
    public function getFollowersIds($parameters);


    /**
     * @param UserParameters $parameters
     *
     * @return Followers|null
     */
    public function getFollowersList($parameters);


    /**
     * @param UserParameters $parameters
     *
     * @return FriendIds|null
     */
    public function getFriendsIds($parameters);


    /**
     * @param UserParameters $parameters
     *
     * @return Friends|null
     */
    public function getFriendsList($parameters);


}