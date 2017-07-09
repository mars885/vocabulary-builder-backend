<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 11/2/17
 * Time: 2:34 PM
 */

namespace App\Repositories\Interfaces;

use App\Model\Parameters\WordParameters;
use App\Model\Word;

interface WordRepositoryInterface {


    /**
     * @param WordParameters $parameters
     *
     * @return Word|null
     */
    public function search($parameters);


}