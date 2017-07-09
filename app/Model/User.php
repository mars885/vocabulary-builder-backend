<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/21/17
 * Time: 9:38 PM
 */

namespace App\Model;

use App\Utils\Utils;
use JsonSerializable;

class User extends BaseModel implements JsonSerializable {


    const JSON_PROPERTY_ID = 'id';
    const JSON_PROPERTY_USER_NAME = 'user_name';
    const JSON_PROPERTY_FULL_NAME = 'full_name';
    const JSON_PROPERTY_EMAIL = 'email';
    const JSON_PROPERTY_PASSWORD = 'password';
    const JSON_PROPERTY_FOLLOWER_COUNT = 'follower_count';
    const JSON_PROPERTY_FRIEND_COUNT = 'friend_count';
    const JSON_PROPERTY_IS_ACTIVATED = 'is_activated';
    const JSON_PROPERTY_IS_FOLLOWING = 'is_following';


    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $userName;

    /**
     * @var string
     */
    protected $fullName;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var int
     */
    protected $friendCount;

    /**
     * @var int
     */
    protected $followerCount;

    /**
     * @var bool|null
     */
    protected $isActivated;

    /**
     * @var bool|null
     */
    protected $isFollowing;




    public function __construct() {
        parent::__construct();

        $this->id = -1;
        $this->userName = '';
        $this->fullName = '';
        $this->email = '';
        $this->password = '';
        $this->friendCount = -1;
        $this->followerCount = -1;
        $this->isActivated = null;
        $this->isFollowing = null;
    }




    /**
     * @param int $id
     * @return $this
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }




    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }




    /**
     * @return bool
     */
    public function hasId() {
        return ($this->id > 0);
    }




    /**
     * @param string $userName
     * @return $this
     */
    public function setUserName($userName) {
        $this->userName = $userName;
        return $this;
    }




    /**
     * @return string
     */
    public function getUserName() {
        return $this->userName;
    }




    /**
     * @return bool
     */
    public function hasUserName() {
        return Utils::isNotEmpty($this->userName);
    }




    /**
     * @param string $fullName
     * @return $this
     */
    public function setFullName($fullName) {
        $this->fullName = $fullName;
        return $this;
    }




    /**
     * @return string
     */
    public function getFullName() {
        return $this->fullName;
    }




    /**
     * @return bool
     */
    public function hasFullName() {
        return Utils::isNotEmpty($this->fullName);
    }




    /**
     * @param string $email
     * @return $this
     */
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }


    /**
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }




    /**
     * @return bool
     */
    public function hasEmail() {
        return Utils::isNotEmpty($this->email);
    }




    /**
     * @param string $password
     * @return $this
     */
    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }




    /**
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }




    /**
     * @return bool
     */
    public function hasPassword() {
        return Utils::isNotEmpty($this->password);
    }




    /**
     * @param int $friendCount
     * @return $this
     */
    public function setFriendCount($friendCount) {
        $this->friendCount = $friendCount;
        return $this;
    }




    /**
     * @return int
     */
    public function getFriendCount() {
        return $this->friendCount;
    }




    /**
     * @return bool
     */
    public function hasFriendCount() {
        return ($this->friendCount > 0);
    }




    /**
     * @param int $followerCount
     * @return $this
     */
    public function setFollowerCount($followerCount) {
        $this->followerCount = $followerCount;
        return $this;
    }




    /**
     * @return int
     */
    public function getFollowerCount() {
        return $this->followerCount;
    }




    /**
     * @return bool
     */
    public function hasFollowerCount() {
        return ($this->followerCount > 0);
    }




    /**
     * @param bool|null $isActivated
     * @return $this
     */
    public function setActivated($isActivated) {
        $this->isActivated = $isActivated;
        return $this;
    }




    /**
     * @return bool|null
     */
    public function isActivated() {
        return $this->isActivated;
    }




    /**
     * @return bool
     */
    public function hasIsActivated() {
        return Utils::isNotNull($this->isActivated);
    }




    /**
     * @param bool|null $isFollowing
     * @return $this
     */
    public function setFollowing($isFollowing) {
        $this->isFollowing = $isFollowing;
        return $this;
    }




    /**
     * @return bool|null
     */
    public function isFollowing() {
        return $this->isFollowing;
    }




    /**
     * @return bool
     */
    public function hasIsFollowing() {
        return Utils::isNotNull($this->isFollowing);
    }




    /**
     * @inheritdoc
     */
    public function jsonSerialize() {
        $results = array();

        if($this->hasId()) {
            $results[self::JSON_PROPERTY_ID] = $this->id;
        }

        if($this->hasUserName()) {
            $results[self::JSON_PROPERTY_USER_NAME] = $this->userName;
        }

        if($this->hasFullName()) {
            $results[self::JSON_PROPERTY_FULL_NAME] = $this->fullName;
        }

        if($this->hasEmail()) {
            $results[self::JSON_PROPERTY_EMAIL] = $this->email;
        }

        if($this->hasPassword()) {
            $results[self::JSON_PROPERTY_PASSWORD] = $this->password;
        }

        if($this->hasFriendCount()) {
            $results[self::JSON_PROPERTY_FRIEND_COUNT] = $this->friendCount;
        }

        if($this->hasFollowerCount()) {
            $results[self::JSON_PROPERTY_FOLLOWER_COUNT] = $this->followerCount;
        }

        if($this->hasIsActivated()) {
            $results[self::JSON_PROPERTY_IS_ACTIVATED] = $this->isActivated;
        }

        if($this->hasIsFollowing()) {
            $results[self::JSON_PROPERTY_IS_FOLLOWING] = $this->isFollowing;
        }

        return $results;
    }




}