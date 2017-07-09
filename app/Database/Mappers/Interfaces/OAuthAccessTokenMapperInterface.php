<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/29/17
 * Time: 4:40 AM
 */

namespace App\Database\Mappers\Interfaces;

use App\Model\Parameters\OAuthAccessTokenParameters;

interface OAuthAccessTokenMapperInterface {


    /**
     * @param OAuthAccessTokenParameters $parameters
     */
    public function insertAccessToken($parameters);


    /**
     * @param OAuthAccessTokenParameters $parameters
     */
    public function revokeAccessToken($parameters);


    /**
     * @param OAuthAccessTokenParameters $parameters
     *
     * @return bool
     */
    public function isAccessTokenRevoked($parameters);


}