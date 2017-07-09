<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/10/17
 * Time: 3:28 AM
 */

namespace App\Handlers;

use App\Model\Constants\StatusCodes;
use Slim\Http\Request;
use Slim\Http\Response;

class NotAllowedHandler {




    /**
     * @param Request $request
     * @param Response $response
     * @param array $methods
     * @return Response
     */
    public function __invoke($request, $response, $methods) {
        // Creating allowed methods string
        $allowedMethodsStr = implode(', ', $methods);

        // Generating JSON
        $json = [
            'status' => 'error',
            'error' => [
                'type' => 'method_not_allowed',
                'description' => 'Method must be one of: ' . $allowedMethodsStr
            ]
        ];

        return $response
            ->withHeader('Allow', $allowedMethodsStr)
            ->withJson($json, StatusCodes::METHOD_NOW_ALLOWED);
    }




}