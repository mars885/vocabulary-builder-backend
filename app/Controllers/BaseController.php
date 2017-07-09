<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 11/19/17
 * Time: 2:48 PM
 */

namespace App\Controllers;

use App\Utils\ContainerWrapper;
use Interop\Container\ContainerInterface;

abstract class BaseController {


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