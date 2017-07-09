<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 11/2/17
 * Time: 2:34 PM
 */

namespace App\Repositories;

use App\Repositories\Interfaces\WordRepositoryInterface;
use Interop\Container\ContainerInterface;

class WordRepository extends BaseRepository implements WordRepositoryInterface {




    /**
     * @param ContainerInterface $container
     */
    public function __construct($container) {
        parent::__construct($container);
    }




    /**
     * @inheritdoc
     */
    public function search($parameters) {
        return $this->container->getWordMapper()->search(
            $parameters,
            $this->container->getConfig()['assets']['pronunciation_audio']['accents']
        );
    }




}