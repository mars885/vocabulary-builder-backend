<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/22/17
 * Time: 8:41 PM
 */

namespace App\Model\Constants;

abstract class OAuthClientTypes {


    const WEB_SERVER_BASED_ID = 1;
    const WEB_SERVER_BASED = 'web-server-based';

    const BROWSER_BASED_ID = 2;
    const BROWSER_BASED = 'browser-based';

    const NATIVE_CLIENT_ID = 3;
    const NATIVE = 'native';

    const MOBILE_ID = 4;
    const MOBILE = 'mobile';


}