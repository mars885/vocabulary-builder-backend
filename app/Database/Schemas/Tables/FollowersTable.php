<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 11/18/17
 * Time: 11:14 PM
 */

namespace App\Database\Schemas\Tables;

abstract class FollowersTable extends BaseTable {


    // Table name
    const TABLE_NAME = 'followers';

    // Columns
    const FOLLOWER_ID = 'follower_id';
    const FOLLOWER_ID_DATA_TYPE = 'INT(11) UNSIGNED';

    const FRIEND_ID = 'friend_id';
    const FRIEND_ID_DATA_TYPE = 'INT(11) UNSIGNED';


}