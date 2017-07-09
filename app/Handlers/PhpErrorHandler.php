<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/15/17
 * Time: 8:45 PM
 */

namespace App\Handlers;

use App\Model\Constants\ContentTypes;
use App\Model\Constants\StatusCodes;
use App\Utils\Logger;
use App\Utils\Renderer;
use Slim\Http\Body;
use Slim\Http\Request;
use Slim\Http\Response;

class PhpErrorHandler {


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
     * @param \Throwable $error
     * @return Response
     */
    public function __invoke($request, $response, $error) {
        // Logging the error
        Logger::logError($error);

        // Generating HTML for response
        $body = new Body(fopen('php://temp', 'r+'));
        $body->write(Renderer::renderHtmlInternalErrorOutput($error, $this->displayErrorDetails));

        // Returning the response with HTML
        return $response
            ->withStatus(StatusCodes::INTERNAL_SERVER_ERROR)
            ->withHeader('Content-Type', ContentTypes::HTML)
            ->withBody($body);
    }




}