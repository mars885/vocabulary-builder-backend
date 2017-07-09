<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/10/17
 * Time: 3:55 AM
 */

namespace App\Exceptions;

use App\Model\Constants\StatusCodes;
use App\Utils\Utils;

class BadRequestException extends BaseException {




    /**
     * @param string $parameter
     * @param null|string $hint
     *
     * @return static
     */
    public static function invalidParameter($parameter, $hint = null) {
        $errorType = 'invalid_parameter';
        $message = 'The request is missing a required parameter, includes an invalid parameter value, ' .
            'includes a parameter more than once, or is otherwise malformed.';
        $hint = (Utils::isNull($hint) ? sprintf('Check the `%s` parameter.', $parameter) : $hint);

        return new static(
            $message,
            StatusCodes::BAD_REQUEST,
            $errorType,
            $hint
        );
    }




    /**
     * @param string $header
     * @param null|string $hint
     *
     * @return static
     */
    public static function invalidHeader($header, $hint = null) {
        $errorType = 'invalid_header';
        $message = 'The request is missing a required header, includes an invalid header value, ' .
            'includes a header more than once, or is otherwise malformed.';
        $hint = (Utils::isNull($hint) ? sprintf('Check the `%s` header.', $header) : $hint);

        return new static(
            $message,
            StatusCodes::BAD_REQUEST,
            $errorType,
            $hint
        );
    }




}