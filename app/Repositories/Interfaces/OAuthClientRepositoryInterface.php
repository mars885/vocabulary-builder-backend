<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/15/17
 * Time: 5:04 PM
 */

namespace App\Repositories\Interfaces;

use App\Model\OAuthClient;

interface OAuthClientRepositoryInterface {


    /**
     * @param string $clientId The client's identifier
     * @param string|null $clientSecret The client's secret (if sent)
     * @param string $grantType The grant type used
     * @param bool $mustValidateSecret If true, it must be attempted to validate the secret
     *
     * @return OAuthClient|null
     */
    public function getClient($clientId, $clientSecret, $grantType, $mustValidateSecret);


}