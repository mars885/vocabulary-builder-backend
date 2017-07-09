<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/13/17
 * Time: 10:58 PM
 */

namespace App\Controllers;

use App\Model\Constants\StatusCodes;
use App\Model\Constants\StatusTypes;
use App\Utils\ParametersCommon;
use Interop\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class OAuth2Controller extends BaseController {




    /**
     * @param ContainerInterface $container
     */
    public function __construct($container) {
        parent::__construct($container);
    }




    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function token($request, $response) {
        // Allowing the auth server to generate a response
        $response = $this->container->getAuthorizationServer()->respondToTokenRequest($request, $response);

        // Returning the response
        return $response;
    }




    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function authorize($request, $response) {
        // Returning the response
        return $response;
    }




    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function verifyCredentials($request, $response) {
        // Fetching the parameters
        $parameters = ParametersCommon::getParametersForVerifyingCredentials($request);

        // Fetching the data from the repository
        $data = $this->container->getUserRepository()->getAuthenticatedUser($parameters);

        // Generating JSON
        $json = [
            'status' => StatusTypes::SUCCESS,
            'data' => $data
        ];

        // Returning JSON
        return $response->withJson($json, StatusCodes::OK);
    }




}