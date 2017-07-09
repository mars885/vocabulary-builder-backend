<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/13/17
 * Time: 11:22 PM
 */

namespace App\Controllers;

use App\Model\Constants\StatusCodes;
use Interop\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class AccountController extends BaseController {




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
    public function register($request, $response) {
        return $response->withJson(['status' => 'success'], StatusCodes::OK);
    }




    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function activate($request, $response) {
        return $response->withJson(['status' => 'success'], StatusCodes::OK);
    }




    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function resendConfirmationEmail($request, $response) {
        return $response->withJson(['status' => 'success'], StatusCodes::OK);
    }




    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function changePassword($request, $response) {
        return $response->withJson(['status' => 'success'], StatusCodes::OK);
    }




    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function changeEmail($request, $response) {
        return $response->withJson(['status' => 'success'], StatusCodes::OK);
    }




}