<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/29/17
 * Time: 11:59 PM
 */

// Requiring the bootstrap
require_once __DIR__ . '/bootstrap/app.php';

// Fetching the pdo
$pdo = $app->getContainer()->get('pdo');
// Fetching the DB name
$databaseName = $app->getContainer()->get('settings')['database']['name'];

return [


    'paths' => [


        'migrations' => 'database/migrations',


        'seeds' => [


            'database/seeds',


        ]


    ],


    'templates' => [


        'file' => 'resources/database/migrations/MigrationStub.php.dist',


    ],


    'environments' => [


        'default_migration_table' => 'migrations',


        'default' => [


            'name' => $databaseName,


            'connection' => $pdo


        ],


    ]


];