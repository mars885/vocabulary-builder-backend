<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/9/17
 * Time: 6:15 PM
 */

namespace App\Exceptions;

use App\Model\Constants\StatusCodes;

class OperationException extends BaseException {




    /**
     * @param string $tokenType
     * @return static
     */
    public static function tokenRevocationFailed($tokenType) {
        $errorType = 'token_revocation_fail';
        $message = 'Failed to revoke the ' . $tokenType . ' token in the database.';

        return new static(
            $message,
            StatusCodes::INTERNAL_SERVER_ERROR,
            $errorType
        );
    }




    /**
     * @return static
     */
    public static function accessTokenRevocationFailed() {
        return self::tokenRevocationFailed('access');
    }




    /**
     * @return static
     */
    public static function refreshTokenRevocationFailed() {
        return self::tokenRevocationFailed('refresh');
    }




    /**
     * @return static
     */
    public static function userFollowingFailed() {
        $errorType = 'user_following_fail';
        $message = 'Failed to follow a user.';

        return new static(
            $message,
            StatusCodes::BAD_REQUEST,
            $errorType
        );
    }




    /**
     * @return static
     */
    public static function userUnfollowingFailed() {
        $errorType = 'user_unfollowing_fail';
        $message = 'Failed to unfollow a user.';

        return new static(
            $message,
            StatusCodes::BAD_REQUEST,
            $errorType
        );
    }




}