<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 11/2/17
 * Time: 4:13 PM
 */

namespace App\Repositories;

use App\Utils\ContainerWrapper;
use Interop\Container\ContainerInterface;

abstract class BaseRepository {


    /**
     * @var ContainerWrapper
     */
    protected $container;




    /**
     * @param ContainerInterface $container
     */
    protected function __construct($container) {
        $this->container = new ContainerWrapper($container);
    }




}