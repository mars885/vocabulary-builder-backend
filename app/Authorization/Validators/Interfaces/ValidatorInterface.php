<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/24/17
 * Time: 2:16 AM
 */

namespace App\Authorization\Validators\Interfaces;

use App\Model\OAuthScope;
use Slim\Http\Request;

interface ValidatorInterface {


    /**
     * Validates the request by investigating the provided access token in the Authorization header
     * as well as checks whether the access access has the specified scopes to access the protected
     * resources.
     *
     * @param Request $request
     * @param OAuthScope[] $requiredScopes
     *
     * @return Request
     */
    public function validate($request, $requiredScopes);


}