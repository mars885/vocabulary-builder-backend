<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/29/17
 * Time: 4:41 AM
 */

namespace App\Database\Mappers\Interfaces;

use App\Model\Parameters\OAuthRefreshTokenParameters;

interface OAuthRefreshTokenMapperInterface {


    /**
     * @param OAuthRefreshTokenParameters $parameters
     */
    public function insertRefreshToken($parameters);


    /**
     * @param OAuthRefreshTokenParameters $parameters
     */
    public function revokeRefreshToken($parameters);


    /**
     * @param OAuthRefreshTokenParameters $parameters
     *
     * @return bool
     */
    public function isRefreshTokenRevoked($parameters);


}