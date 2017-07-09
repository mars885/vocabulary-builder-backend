<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/29/17
 * Time: 3:59 AM
 */

namespace App\Database\Mappers\Interfaces;

use App\Model\OAuthClient;
use App\Model\Parameters\OAuthClientParameters;

interface OAuthClientMapperInterface {


    /**
     * @param OAuthClientParameters $parameters
     *
     * @return OAuthClient|null
     */
    public function getClientByIdAndGrantType($parameters);


}