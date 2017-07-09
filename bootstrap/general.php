<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 1/11/18
 * Time: 4:06 AM
 */

use App\Model\Constants\Dependencies;

$app->getContainer()[Dependencies::PDO] = function($container) {
    $databaseConfig = $container['settings']['database'];

    $pdo = new PDO(
        $databaseConfig['driver'] . ':host=' . $databaseConfig['host'] . ';dbname=' . $databaseConfig['name'],
        $databaseConfig['username'],
        $databaseConfig['password']
    );
    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        ($container['settings']['debug'] ? PDO::ERRMODE_EXCEPTION : PDO::ERRMODE_SILENT)
    );
    $pdo->setAttribute(
        PDO::ATTR_DEFAULT_FETCH_MODE,
        PDO::FETCH_ASSOC
    );

    return $pdo;
};