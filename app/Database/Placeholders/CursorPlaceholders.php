<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 1/10/18
 * Time: 11:52 PM
 */

namespace App\Database\Placeholders;

abstract class CursorPlaceholders {


    const ID = ':id';
    const FOLLOWER_COUNT = ':followerCount';
    const CREATED_AT = ':createdAt';
    const LIMIT = ':limit';


}