<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/31/17
 * Time: 11:23 AM
 */

namespace App\Model\Parameters;

use App\Utils\Utils;

class UserParameters extends BaseParameters {


    /**
     * @var int
     */
    protected $userId;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $query;

    /**
     * @var int[]
     */
    protected $userIds;

    /**
     * @var CursorParameters|null
     */
    protected $cursorParameters;




    public function __construct() {
        parent::__construct();

        $this->userId = -1;
        $this->email = '';
        $this->query = '';
        $this->userIds = array();
        $this->cursorParameters = null;
    }




    /**
     * @param int $userId
     * @return $this
     */
    public function setUserId($userId) {
        $this->userId = $userId;
        return $this;
    }




    /**
     * @return int
     */
    public function getUserId() {
        return $this->userId;
    }




    /**
     * @return bool
     */
    public function hasUserId() {
        return ($this->userId !== -1);
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
     * @param string $query
     * @return $this
     */
    public function setQuery($query) {
        $this->query = $query;
        return $this;
    }




    /**
     * @return string
     */
    public function getQuery() {
        return $this->query;
    }




    /**
     * @return bool
     */
    public function hasQuery() {
        return Utils::isNotEmpty($this->query);
    }




    /**
     * @param int[] $userIds
     * @return $this
     */
    public function setUserIds($userIds) {
        $this->userIds = $userIds;
        return $this;
    }




    /**
     * @return int[]
     */
    public function getUserIds() {
        return $this->userIds;
    }




    /**
     * @return bool
     */
    public function hasUserIds() {
        return Utils::isValid($this->userIds);
    }




    /**
     * @param CursorParameters $cursorParameters
     * @return $this
     */
    public function setCursorParameters($cursorParameters) {
        $this->cursorParameters = $cursorParameters;
        return $this;
    }




    /**
     * @return CursorParameters|null
     */
    public function getCursorParameters() {
        return $this->cursorParameters;
    }




    /**
     * @return bool
     */
    public function hasCursorParameters() {
        return Utils::isNotNull($this->cursorParameters);
    }




}