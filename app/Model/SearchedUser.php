<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/24/17
 * Time: 12:33 AM
 */

namespace App\Model;

use App\Model\Interfaces\Cursorable;

class SearchedUser extends User implements Cursorable {




    /**
     * @inheritdoc
     */
    public function toCursor() {
        $cursor = new Cursor();

        $parameter = new Parameter();
        $parameter->setKey(Cursor::COLUMN_FOLLOWER_COUNT);
        $parameter->setValue($this->followerCount);

        $cursor->addParameter(Cursor::COLUMN_FOLLOWER_COUNT, $parameter);

        $parameter = new Parameter();
        $parameter->setKey(Cursor::COLUMN_ID);
        $parameter->setValue($this->id);

        $cursor->addParameter(Cursor::COLUMN_ID, $parameter);

        return $cursor;
    }




}