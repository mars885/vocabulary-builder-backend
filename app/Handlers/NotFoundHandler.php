<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/13/17
 * Time: 9:16 PM
 */

namespace App\Handlers;

use App\Model\Constants\StatusCodes;
use Slim\Http\Body;
use Slim\Http\Request;
use Slim\Http\Response;

class NotFoundHandler {





    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function __invoke($request, $response) {
        $body = new Body(fopen('php://temp', 'r+'));
        $body->write($this->renderHtmlNotFoundOutput());

        return $response
            ->withStatus(StatusCodes::NOT_FOUND)
            ->withHeader('Content-Type', 'text/html')
            ->withBody($body);
    }




    /**
     * @return string
     */
    private function renderHtmlNotFoundOutput() {
        // TODO: Perhaps add 'Visit the home page' button when the web-site
        // will be up and running.
        return <<<END
<html>
    <head>
        <title>Page Not Found</title>
        <style>
            body{
                margin:0;
                padding:30px;
                font:12px/1.5 Helvetica,Arial,Verdana,sans-serif;
            }
            h1{
                margin:0;
                font-size:48px;
                font-weight:normal;
                line-height:48px;
            }
            strong{
                display:inline-block;
                width:65px;
            }
        </style>
    </head>
    <body>
        <h1>Page Not Found</h1>
        <p>
            The page you are looking for could not be found. Check the address bar
            to ensure your URL is spelled correctly.
        </p>
    </body>
</html>
END;
    }




}