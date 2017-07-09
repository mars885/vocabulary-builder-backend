<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 7/11/17
 * Time: 1:20 AM
 */

namespace App\Model\Constants;

abstract class StatusCodes {




    /**
     * Success.
     */
    const OK = 200;




    /**
     * The server successfully processed the request and is not returning any content.
     */
    const NO_CONTENT = 204;




    /**
     * There was no new data to return.
     */
    const NOT_MODIFIED = 304;




    /**
     * The request is invalid or cannot be understood by the server. An accompanying error
     * message will explain further. Requests without authentication are considered
     * invalid and will yield this response.
     */
    const BAD_REQUEST = 400;




    /**
     * Missing or incorrect authentication credentials.
     */
    const UNAUTHORIZED = 401;




    /**
     * The request is understood, but it has been refused or access is not allowed.
     */
    const FORBIDDEN = 403;




    /**
     * The URI request is invalid or the resource requested does not exist.
     */
    const NOT_FOUND = 404;




    /**
     * Indicates that the request method is known by the server but has
     * been disabled and cannot be used.
     */
    const METHOD_NOW_ALLOWED = 405;




    /**
     * Returned by the server when an invalid format is specified in the request.
     */
    const NOT_ACCEPTABLE = 406;




    /**
     * This resource is gone. Either moved to another location or removed completely.
     */
    const GONE = 410;




    /**
     * Something is broken on the server.
     */
    const INTERNAL_SERVER_ERROR = 500;




    /**
     * The server is overloaded with request. Try again later.
     */
    const SERVICE_UNAVAILABLE = 503;




}