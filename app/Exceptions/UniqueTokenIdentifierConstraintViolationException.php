<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/15/17
 * Time: 6:03 PM
 */

namespace App\Exceptions;

use App\Model\Constants\StatusCodes;

class UniqueTokenIdentifierConstraintViolationException extends OAuth2Exception {




    /**
     * @return static
     */
    public static function create() {
        $errorType = 'access_token_duplication';
        $message = 'Could not create unique access token identifier.';

        return new static($message, StatusCodes::INTERNAL_SERVER_ERROR, $errorType);
    }




}