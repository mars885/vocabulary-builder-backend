<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 11/16/17
 * Time: 7:27 PM
 */

namespace App\Middleware;

use App\Exceptions\BadRequestException;
use App\Model\Constants\ContentTypes;
use App\Utils\StringUtils;
use Slim\Http\Request;
use Slim\Http\Response;

class ContentTypeMiddleware {




    /**
     * @param Request $request
     * @param Response $response
     * @param callable $next
     *
     * @throws BadRequestException
     *
     * @return Response
     */
    public function __invoke($request, $response, $next) {
        if($request->isPost() || $request->isPut()) {
            if(!$request->hasHeader('Content-Type')) {
                throw BadRequestException::invalidHeader('Content-Type', 'Unknown `Content-Type` header value.');
            }

            if(!StringUtils::contains($request->getContentType(), ContentTypes::JSON)) {
                throw BadRequestException::invalidHeader('Content-Type');
            }
        }

        return $next($request, $response);
    }




}