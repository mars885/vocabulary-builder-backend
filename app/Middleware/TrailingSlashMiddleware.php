<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 9/20/17
 * Time: 9:13 PM
 */

namespace App\Middleware;

use App\Utils\StringUtils;
use Slim\Http\Request;
use Slim\Http\Response;

class TrailingSlashMiddleware {




    /**
     * @param Request $request
     * @param Response $response
     * @param callable $next
     * @return Response
     */
    public function __invoke($request, $response, $next) {
        $uri = $request->getUri();
        $path = $uri->getPath();

        if(($path !== '/') && StringUtils::endsWith($path, '/')) {
            $uri = $uri->withPath(rtrim($path, '/'));
            return $next($request->withUri($uri), $response);
        }

        return $next($request, $response);
    }




}