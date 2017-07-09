<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 11/26/17
 * Time: 4:51 PM
 */

namespace App\Database\Schemas\Tables;

abstract class OAuthScopeDomainsTable extends BaseTable {


    // Table name
    const TABLE_NAME = 'oauth_scope_domains';

    // Columns
    const ID = 'id';
    const ID_DATA_TYPE = 'TINYINT UNSIGNED';

    const DOMAIN = 'domain';
    const DOMAIN_DATA_TYPE = 'VARCHAR(15)';


}