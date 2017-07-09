<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/29/17
 * Time: 3:35 AM
 */

namespace App\Database\Mappers\Interfaces;

use App\Model\Parameters\WordParameters;
use App\Model\Word;

interface WordMapperInterface {


    /**
     * @param WordParameters $parameters
     * @param array $accentsConfig
     *
     * @return Word|null
     */
    public function search($parameters, $accentsConfig);


}