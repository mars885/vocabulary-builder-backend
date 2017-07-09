<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/21/17
 * Time: 11:55 PM
 */

namespace App\Database\Schemas\Tables;

abstract class OAuthClientEndpointsTable extends BaseTable {


    // Table name
    const TABLE_NAME = 'oauth_client_endpoints';

    // Columns
    const ID = 'id';
    const ID_DATA_TYPE = 'INT(11) UNSIGNED';

    const CLIENT_ID = 'client_id';
    const CLIENT_ID_DATA_TYPE = 'VARCHAR(32)';

    const REDIRECT_URL = 'redirect_url';
    const REDIRECT_URL_DATA_TYPE = 'TEXT';


}