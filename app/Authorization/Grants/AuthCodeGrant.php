<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/15/17
 * Time: 7:28 PM
 */

namespace App\Authorization\Grants;

use App\Model\Constants\OAuthGrantTypes;

class AuthCodeGrant extends BaseGrant {




    /**
     * {@inheritdoc}
     */
    public function respondToTokenRequest($request, $response, $accessTokenTTL) {
        // TODO: Implement respondToAccessTokenRequest() method.
    }




    /**
     * {@inheritdoc}
     */
    protected function validateClient($request) {
        // TODO: Implement validateClient() method.
    }




    /**
     * @return string
     */
    public function getId() {
        return OAuthGrantTypes::AUTHORIZATION_CODE;
    }




}