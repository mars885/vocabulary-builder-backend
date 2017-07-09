<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/29/17
 * Time: 4:18 AM
 */

namespace App\Database\Mappers\Interfaces;

use App\Model\OAuthScope;
use App\Model\Parameters\OAuthScopeParameters;

interface OAuthScopeMapperInterface {


    /**
     * @param OAuthScopeParameters $parameters
     *
     * @return OAuthScope|null
     */
    public function getScopeForClient($parameters);


}