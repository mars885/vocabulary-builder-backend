<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 9/20/17
 * Time: 6:53 PM
 */

namespace App\Controllers;

use App\Model\Constants\StatusCodes;
use App\Model\Constants\StatusTypes;
use App\Utils\ParametersCommon;
use Interop\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class WordController extends BaseController {




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
        $parameters = ParametersCommon::getParametersForWordsSearch($request);

        // Fetching the data from the repository
        $data = $this->container->getWordRepository()->search($parameters);

        // Generating JSON
        $json = [
            'status' => StatusTypes::SUCCESS,
            'data' => $data
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
        // Returning JSON
        return $response->withJson(['status' => StatusTypes::SUCCESS], StatusCodes::OK);
    }




    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function lookupById($request, $response) {
        // Returning JSON
        return $response->withJson(['status' => StatusTypes::SUCCESS], StatusCodes::OK);
    }




    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function learningWordsIds($request, $response) {
        // Returning JSON
        return $response->withJson(['status' => StatusTypes::SUCCESS], StatusCodes::OK);
    }




    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function learningWordsList($request, $response) {
        // Returning JSON
        return $response->withJson(['status' => StatusTypes::SUCCESS], StatusCodes::OK);
    }




    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function learnWordById($request, $response) {
        // Returning JSON
        return $response->withJson(['status' => StatusTypes::SUCCESS], StatusCodes::OK);
    }




    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function learnWordsByIds($request, $response) {
        // Returning JSON
        return $response->withJson(['status' => StatusTypes::SUCCESS], StatusCodes::OK);
    }




    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function unlearnWordById($request, $response) {
        // Returning JSON
        return $response->withJson(['status' => StatusTypes::SUCCESS], StatusCodes::OK);
    }




    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function unlearnWordsByIds($request, $response) {
        // Returning JSON
        return $response->withJson(['status' => StatusTypes::SUCCESS], StatusCodes::OK);
    }




    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function masteredWordsIds($request, $response) {
        // Returning JSON
        return $response->withJson(['status' => StatusTypes::SUCCESS], StatusCodes::OK);
    }




    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function masteredWordsList($request, $response) {
        // Returning JSON
        return $response->withJson(['status' => StatusTypes::SUCCESS], StatusCodes::OK);
    }




    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function masterWordById($request, $response) {
        // Returning JSON
        return $response->withJson(['status' => StatusTypes::SUCCESS], StatusCodes::OK);
    }




    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function masterWordsByIds($request, $response) {
        // Returning JSON
        return $response->withJson(['status' => StatusTypes::SUCCESS], StatusCodes::OK);
    }




    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function unmasterWordById($request, $response) {
        // Returning JSON
        return $response->withJson(['status' => StatusTypes::SUCCESS], StatusCodes::OK);
    }




    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function unmasterWordsByIds($request, $response) {
        // Returning JSON
        return $response->withJson(['status' => StatusTypes::SUCCESS], StatusCodes::OK);
    }




    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function homeTimeline($request, $response) {
        // Returning JSON
        return $response->withJson(['status' => StatusTypes::SUCCESS], StatusCodes::OK);
    }




    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function likedWordsIds($request, $response) {
        // Returning JSON
        return $response->withJson(['status' => StatusTypes::SUCCESS], StatusCodes::OK);
    }




    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function likedWordsList($request, $response) {
        // Returning JSON
        return $response->withJson(['status' => StatusTypes::SUCCESS], StatusCodes::OK);
    }




    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function likeWordById($request, $response) {
        // Returning JSON
        return $response->withJson(['status' => StatusTypes::SUCCESS], StatusCodes::OK);
    }




    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function likeWordsByIds($request, $response) {
        // Returning JSON
        return $response->withJson(['status' => StatusTypes::SUCCESS], StatusCodes::OK);
    }




    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function unlikeWordById($request, $response) {
        // Returning JSON
        return $response->withJson(['status' => StatusTypes::SUCCESS], StatusCodes::OK);
    }




    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function unlikeWordsByIds($request, $response) {
        // Returning JSON
        return $response->withJson(['status' => StatusTypes::SUCCESS], StatusCodes::OK);
    }




    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function trendingWords($request, $response) {
        // Returning JSON
        return $response->withJson(['status' => StatusTypes::SUCCESS], StatusCodes::OK);
    }




    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function wordOfTheDay($request, $response) {
        // Returning JSON
        return $response->withJson(['status' => StatusTypes::SUCCESS], StatusCodes::OK);
    }




}