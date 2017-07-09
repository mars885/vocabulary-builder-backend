<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 11/2/17
 * Time: 6:10 PM
 */

namespace App\Repositories;

use App\Repositories\Interfaces\AccountRepositoryInterface;
use Interop\Container\ContainerInterface;

class AccountRepository extends BaseRepository implements AccountRepositoryInterface {




    /**
     * @param ContainerInterface $container
     */
    public function __construct($container) {
        parent::__construct($container);
    }




}