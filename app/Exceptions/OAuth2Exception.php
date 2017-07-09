<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/15/17
 * Time: 4:06 PM
 */

namespace App\Exceptions;

use App\Model\Constants\StatusCodes;

class OAuth2Exception extends BaseException {




    /**
     * @return static
     */
    public static function unsupportedGrantType() {
        $errorType = 'unsupported_grant_type';
        $message = 'The authorization grant type is not supported by the authorization server.';
        $hint = 'Check the `grant_type` parameter.';

        return new static(
            $message,
            StatusCodes::BAD_REQUEST,
            $errorType,
            $hint
        );
    }




    /**
     * @return static
     */
    public static function invalidClient() {
        $errorType = 'invalid_client';
        $message = 'Client authentication failed.';

        return new static(
            $message,
            StatusCodes::UNAUTHORIZED,
            $errorType
        );
    }




    /**
     * @param string $scope
     * @return static
     */
    public static function invalidScope($scope) {
        $errorType = 'invalid_scope';
        $message = 'The requested scope is invalid, unknown, or malformed.';
        $hint = sprintf(
            'Check the `%s` scope.',
            htmlspecialchars($scope, ENT_QUOTES, 'UTF-8', false)
        );

        return new static(
            $message,
            StatusCodes::BAD_REQUEST,
            $errorType,
            $hint
        );
    }




    /**
     * @return static
     */
    public static function invalidCredentials() {
        $errorType = 'invalid_credentials';
        $message = 'The user credentials were incorrect.';

        return new static(
            $message,
            StatusCodes::UNAUTHORIZED,
            $errorType
        );
    }




    /**
     * @param string|null $hint
     * @return static
     */
    public static function accessDenied($hint = null) {
        $errorType = 'access_denied';
        $message = 'The resource owner or authorization server denied the request.';

        return new static(
            $message,
            StatusCodes::UNAUTHORIZED,
            $errorType,
            $hint
        );
    }




    /**
     * @param string $hint
     *
     * @return static
     */
    public static function invalidGrant($hint) {
        $errorType = 'invalid_grant';
        $message = 'The provided authorization grant (e.g., authorization code, resource owner credentials) is'
            . 'invalid, expired, revoked, does not match the redirection URI used in the authorization request, '
            . 'or was issued to another client.';

        return new static(
            $message,
            StatusCodes::BAD_REQUEST,
            $errorType,
            $hint
        );
    }





}