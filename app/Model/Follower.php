<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/7/17
 * Time: 12:57 AM
 */

namespace App\Model;

use App\Model\Interfaces\Cursorable;

class Follower extends User implements Cursorable {




    /**
     * @inheritdoc
     */
    public function toCursor() {
        $cursor = new Cursor();

        $parameter = new Parameter();
        $parameter->setKey(Cursor::COLUMN_CREATED_AT);
        $parameter->setValue($this->createdAt);

        $cursor->addParameter(Cursor::COLUMN_CREATED_AT, $parameter);

        return $cursor;
    }




}