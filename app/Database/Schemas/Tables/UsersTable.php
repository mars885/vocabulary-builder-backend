<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 9/24/17
 * Time: 5:57 PM
 */

namespace App\Database\Schemas\Tables;

abstract class UsersTable extends BaseTable {


    // Table name
    const TABLE_NAME = 'users';

    // Columns
    const ID = 'id';
    const ID_DATA_TYPE = 'INT(11) UNSIGNED';

    const USER_NAME = 'user_name';
    const USER_NAME_DATA_TYPE = 'VARCHAR(255)';

    const FULL_NAME = 'full_name';
    const FULL_NAME_DATA_TYPE = 'VARCHAR(255)';

    const EMAIL = 'email';
    const EMAIL_DATA_TYPE = 'VARCHAR(255)';

    const PASSWORD = 'password';
    const PASSWORD_DATA_TYPE = 'VARCHAR(255)';

    const FRIEND_COUNT = 'friend_count';
    const FRIEND_COUNT_DATA_TYPE = 'INT(11) UNSIGNED';

    const FOLLOWER_COUNT = 'follower_count';
    const FOLLOWER_COUNT_DATA_TYPE = 'INT(11) UNSIGNED';

    const IS_ACTIVATED = 'is_activated';
    const IS_ACTIVATED_DATA_TYPE = 'TINYINT(1)';

    const ACTIVATION_TOKEN = 'activation_token';
    const ACTIVATION_TOKEN_DATA_TYPE = 'VARCHAR(255)';


}