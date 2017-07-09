<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 11/2/17
 * Time: 2:34 PM
 */

namespace App\Repositories;

use App\Model\Parameters\UserParameters;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Utils\PasswordUtils;
use App\Utils\Utils;
use Interop\Container\ContainerInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface {




    /**
     * @param ContainerInterface $container
     */
    public function __construct($container) {
        parent::__construct($container);
    }




    /**
     * @inheritdoc
     */
    public function getUserByCredentials($email, $password) {
        // Creating parameters
        $parameters = new UserParameters();
        $parameters->setEmail($email);

        // Fetching the user from the database
        $user = $this->container->getUserMapper()->getUserByEmail($parameters);

        if(Utils::isNull($user)) {
            return null;
        }

        // Checking whether the passwords match
        if(!PasswordUtils::verifyPassword($password, $user->getPassword())) {
            return null;
        }

        // Returning the user
        return $user;
    }




    /**
     * @inheritdoc
     */
    public function getAuthenticatedUser($parameters) {
        return $this->container->getUserMapper()->getAuthenticatedUser($parameters);
    }




    /**
     * @inheritdoc
     */
    public function search($parameters) {
        return $this->container->getUserMapper()->search($parameters);
    }




    /**
     * @inheritdoc
     */
    public function lookupById($parameters) {
        return $this->container->getUserMapper()->lookupById($parameters);
    }




    /**
     * @inheritdoc
     */
    public function lookupByIds($parameters) {
        return $this->container->getUserMapper()->lookupByIds($parameters);
    }




    /**
     * {@inheritdoc}
     */
    public function followUser($parameters) {
        return $this->container->getUserMapper()->followUser($parameters);
    }




    /**
     * {@inheritdoc}
     */
    public function unfollowUser($parameters) {
        return $this->container->getUserMapper()->unfollowUser($parameters);
    }




    /**
     * {@inheritdoc}
     */
    public function getFriendsIds($parameters) {
        return $this->container->getUserMapper()->getFriendsIds($parameters);
    }




    /**
     * {@inheritdoc}
     */
    public function getFriendsList($parameters) {
        return $this->container->getUserMapper()->getFriendsList($parameters);
    }




    /**
     * {@inheritdoc}
     */
    public function getFollowersIds($parameters) {
        return $this->container->getUserMapper()->getFollowersIds($parameters);
    }




    /**
     * {@inheritdoc}
     */
    public function getFollowersList($parameters) {
        return $this->container->getUserMapper()->getFollowersList($parameters);
    }




}