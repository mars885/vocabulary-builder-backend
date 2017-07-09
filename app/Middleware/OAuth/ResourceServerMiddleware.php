<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/15/17
 * Time: 4:05 AM
 */

namespace App\Middleware\OAuth;

use App\Authorization\Servers\ResourceServer;
use App\Model\OAuthScope;
use Slim\Http\Request;
use Slim\Http\Response;

class ResourceServerMiddleware {


    /**
     * @var ResourceServer
     */
    private $server;

    /**
     * @var OAuthScope[]
     */
    private $requiredScopes;




    /**
     * @param ResourceServer $server
     * @param OAuthScope[] $requiredScopes
     */
    public function __construct($server, $requiredScopes) {
        $this->server = $server;
        $this->requiredScopes = $requiredScopes;
    }




    /**
     * @param Request $request
     * @param Response $response
     * @param callable $next
     *
     * @return callable
     */
    public function __invoke($request, $response, $next) {
        $request = $this->server->validateAuthenticatedRequest($request, $this->requiredScopes);

        return $next($request, $response);
    }




}