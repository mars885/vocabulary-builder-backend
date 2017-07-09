<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/21/17
 * Time: 11:46 PM
 */

namespace App\Database\Schemas\Tables;

abstract class OAuthClientsTable extends BaseTable {


    // Table name
    const TABLE_NAME = 'oauth_clients';

    // Columns
    const ID = 'id';
    const ID_DATA_TYPE = 'VARCHAR(32)';

    const SECRET = 'secret';
    const SECRET_DATA_TYPE = 'VARCHAR(50)';

    const CLIENT_TYPE_ID = 'client_type_id';
    const CLIENT_TYPE_ID_DATA_TYPE = 'TINYINT UNSIGNED';

    const OWNER_ID = 'owner_id';
    const OWNER_ID_DATA_TYPE = 'INT(11) UNSIGNED';

    const IS_FIRST_PARTY = 'is_first_party';
    const IS_FIRST_PARTY_DATA_TYPE = 'TINYINT(1)';

    const NAME = 'name';
    const NAME_DATA_TYPE = 'VARCHAR(100)';

    const DESCRIPTION = 'description';
    const DESCRIPTION_DATA_TYPE = 'TEXT';

    const LOGO_FILE_PATH = 'logo_file_path';
    const LOGO_FILE_PATH_DATA_TYPE = 'VARCHAR(100)';


}