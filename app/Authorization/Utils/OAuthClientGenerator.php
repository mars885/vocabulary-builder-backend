<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/21/17
 * Time: 7:04 PM
 */

namespace App\Authorization\Utils;

use App\Model\OAuthClient;
use App\Utils\Utils;

class OAuthClientGenerator {




    /**
     * @return string
     */
    public static function generateClientId() {
        return Utils::generateUniqueString(OAuthClient::CLIENT_ID_LENGTH);
    }




    /**
     * @return string
     */
    public static function generateClientSecret() {
        return Utils::generateUniqueString(OAuthClient::CLIENT_SECRET_LENGTH);
    }




}