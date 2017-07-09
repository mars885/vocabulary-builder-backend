<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/28/17
 * Time: 3:32 PM
 */

namespace App\Controllers;

use App\Exceptions\OperationException;
use App\Model\Constants\StatusCodes;
use App\Model\Constants\StatusTypes;
use App\Paginators\Cursorer;
use App\Utils\ParametersCommon;
use App\Utils\Utils;
use Interop\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class UserController extends BaseController {




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
    public function search($request, $response) {
        // Fetching the parameters
        $parameters = ParametersCommon::getParametersForUsersSearch($request, $this->container->getConfig());

        // Fetching the data from the repository
        $users = $this->container->getUserRepository()->search($parameters);

        // Instantiating a cursorer
        $cursorer = new Cursorer(
            $users,
            $parameters->getCursorParameters()->getCursor(),
            $parameters->getCursorParameters()->getLimit(),
            Utils::getUrlForCursorer($request)
        );

        // Returning JSON
        return $response->withJson($cursorer, StatusCodes::OK);
    }




    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function lookupById($request, $response) {
        // Fetching the parameters
        $parameters = ParametersCommon::getParametersForLookingUpUserById($request);

        // Fetching the data from the repository
        $user = $this->container->getUserRepository()->lookupById($parameters);

        // Creating JSON
        $json = [
            'status' => StatusTypes::SUCCESS,
            'data' => $user
        ];

        // Returning JSON
        return $response->withJson($json, StatusCodes::OK);
    }




    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function lookupByIds($request, $response) {
        // Fetching the parameters
        $parameters = ParametersCommon::getParametersForLookingUpUsersByIds($request);

        // Fetching the data from the repository
        $users = $this->container->getUserRepository()->lookupByIds($parameters);

        // Creating JSON
        $json = [
            'status' => StatusTypes::SUCCESS,
            'data' => $users
        ];

        // Returning JSON
        return $response->withJson($json, StatusCodes::OK);
    }




    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function followUser($request, $response) {
        // Fetching the parameters
        $parameters = ParametersCommon::getParametersForFollowingUser($request);

        // Changing the database by using the repository
        $result = $this->container->getUserRepository()->followUser($parameters);

        // Checking the result
        if(!$result) {
            throw OperationException::userFollowingFailed();
        }

        // Returning JSON
        return $response->withJson(['status' => StatusTypes::SUCCESS], StatusCodes::OK);
    }




    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function unfollowUser($request, $response) {
        // Fetching the parameters
        $parameters = ParametersCommon::getParametersForUnfollowingUser($request);

        // Changing the database by using the repository
        $result = $this->container->getUserRepository()->unfollowUser($parameters);

        // Checking the result
        if(!$result) {
            throw OperationException::userUnfollowingFailed();
        }

        // Returning JSON
        return $response->withJson(['status' => StatusTypes::SUCCESS], StatusCodes::OK);
    }




    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function friendsIds($request, $response) {
        // Fetching the parameters
        $parameters = ParametersCommon::getParametersForFriendsIds($request, $this->container->getConfig());

        // Fetching the data from the repository
        $friendsIds = $this->container->getUserRepository()->getFriendsIds($parameters);

        // Instantiating a cursorer
        $cursorer = new Cursorer(
            $friendsIds,
            $parameters->getCursorParameters()->getCursor(),
            $parameters->getCursorParameters()->getLimit(),
            Utils::getUrlForCursorer($request)
        );

        // Returning JSON
        return $response->withJson($cursorer, StatusCodes::OK);
    }




    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function friendsList($request, $response) {
        // Fetching the parameters
        $parameters = ParametersCommon::getParametersForFriendsList($request, $this->container->getConfig());

        // Fetching the data from the repository
        $friends = $this->container->getUserRepository()->getFriendsList($parameters);

        // Instantiating a cursorer
        $cursorer = new Cursorer(
            $friends,
            $parameters->getCursorParameters()->getCursor(),
            $parameters->getCursorParameters()->getLimit(),
            Utils::getUrlForCursorer($request)
        );

        // Returning JSON
        return $response->withJson($cursorer, StatusCodes::OK);
    }




    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function followersIds($request, $response) {
        // Fetching the parameters
        $parameters = ParametersCommon::getParametersForFollowersIds($request, $this->container->getConfig());

        // Fetching the data from the repository
        $followersIds = $this->container->getUserRepository()->getFollowersIds($parameters);

        // Instantiating a cursorer
        $cursorer = new Cursorer(
            $followersIds,
            $parameters->getCursorParameters()->getCursor(),
            $parameters->getCursorParameters()->getLimit(),
            Utils::getUrlForCursorer($request)
        );

        // Returning JSON
        return $response->withJson($cursorer, StatusCodes::OK);
    }




    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function followersList($request, $response) {
        // Fetching the parameters
        $parameters = ParametersCommon::getParametersForFollowersList($request, $this->container->getConfig());

        // Fetching the data from the repository
        $followers = $this->container->getUserRepository()->getFollowersList($parameters);

        // Instantiating a cursorer
        $cursorer = new Cursorer(
            $followers,
            $parameters->getCursorParameters()->getCursor(),
            $parameters->getCursorParameters()->getLimit(),
            Utils::getUrlForCursorer($request)
        );

        // Returning JSON
        return $response->withJson($cursorer, StatusCodes::OK);
    }




}