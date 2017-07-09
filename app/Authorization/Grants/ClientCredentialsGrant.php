<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/15/17
 * Time: 7:29 PM
 */

namespace App\Authorization\Grants;

use App\Model\Constants\OAuthGrantTypes;

class ClientCredentialsGrant extends BaseGrant {




    /**
     * {@inheritdoc}
     */
    public function respondToTokenRequest($request, $response, $accessTokenTTL) {
        // Validating the request
        $client = $this->validateClient($request);
        $scopes = $this->validateScopes($request, $client);

        // Issuing the access token
        $accessToken = $this->issueAccessToken($accessTokenTTL, $client, $client->getId(), $scopes);

        // Injecting the access token to the response
        $response->setAccessToken($accessToken);

        return $response;
    }




    /**
     * @return string
     */
    public function getId() {
        return OAuthGrantTypes::CLIENT_CREDENTIALS;
    }




}