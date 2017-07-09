<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/15/17
 * Time: 5:04 PM
 */

namespace App\Repositories\Interfaces;

use App\Model\OAuthScope;

interface OAuthScopeRepositoryInterface {


    /**
     * Return information about a scope.
     *
     * @param string $permission The scope's permission
     * @param string $domain The scope's domain
     * @param string $clientId The client's id
     * @param string $grantType The grant type used
     *
     * @return OAuthScope|null
     */
    public function getScopeForClient($permission, $domain, $clientId, $grantType);


}