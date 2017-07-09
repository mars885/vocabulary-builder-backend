<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 1/10/18
 * Time: 11:43 PM
 */

namespace App\Database\Placeholders;

abstract class UserPlaceholders {


    const USER_ID = ':userId';
    const EMAIL = ':email';
    const QUERY = ':query';
    const FOLLOWER_ID = ':followerId';
    const FRIEND_ID = ':friendId';


}