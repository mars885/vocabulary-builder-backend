<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/15/17
 * Time: 8:50 PM
 */

namespace App\Exceptions;

use App\Model\Constants\StatusCodes;

class InternalServerException extends BaseException {




    /**
     * @param string $hint
     * @return static
     */
    public static function serverError($hint) {
        $errorType = 'internal_server_error';
        $message = 'The server encountered an unexpected condition which prevented it from fulfilling the request.';

        return new static(
            $message,
            StatusCodes::INTERNAL_SERVER_ERROR,
            $errorType,
            $hint
        );
    }




}