<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/10/17
 * Time: 3:28 AM
 */

namespace App\Handlers;

use App\Exceptions\BaseException;
use App\Model\Constants\StatusCodes;
use App\Model\Constants\StatusTypes;
use App\Utils\ArrayUtils;
use App\Utils\Logger;
use App\Utils\Utils;
use Exception;
use Slim\Http\Request;
use Slim\Http\Response;

class ErrorHandler {


    /**
     * @var bool
     */
    private $displayErrorDetails;




    /**
     * @param bool $displayErrorDetails
     */
    public function __construct($displayErrorDetails) {
        $this->displayErrorDetails = $displayErrorDetails;
    }




    /**
     * @param Request $request
     * @param Response $response
     * @param Exception $exception
     * @return Response
     */
    public function __invoke($request, $response, $exception) {
        // Logging the error
        Logger::logError($exception);

        // Fetching the basic details about an error
        if($exception instanceof BaseException) {
            $error = [
                'type' => $exception->getErrorType(),
                'message' => $exception->getMessage()
            ];

            if($exception->hasHint()) {
                $error['hint'] = $exception->getHint();
            }

            $code = $exception->getCode();
        } else {
            $error = [
                'type' => Utils::getClassNameWithoutNamespace($exception),
                'message' => $exception->getMessage()
            ];

            $code = StatusCodes::INTERNAL_SERVER_ERROR;
        }

        // Appending more info if debug mode is enabled
        if($this->displayErrorDetails) {
            $error['file'] = $exception->getFile();
            $error['line'] = $exception->getLine();
            $error['trace'] = ArrayUtils::explode("\n", $exception->getTraceAsString());
        }

        // Returning JSON
        return $response->withJson(['status' => StatusTypes::ERROR, 'error' => $error], $code);
    }




}