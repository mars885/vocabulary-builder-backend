<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 9/20/17
 * Time: 6:04 PM
 */

// Requiring the composer autoloader
require __DIR__ . '/../vendor/autoload.php';

// Loading the environment variables
(new \Dotenv\Dotenv(__DIR__ . '/../'))->load();

// Instantiating the app controller
$app = new \Slim\App(['settings' => require_once __DIR__ . '/../config/app.php']);

// Including dependencies
require_once __DIR__ . '/general.php';
require_once __DIR__ . '/servers.php';
require_once __DIR__ . '/controllers.php';
require_once __DIR__ . '/repositories.php';
require_once __DIR__ . '/mappers.php';
require_once __DIR__ . '/handlers.php';

// Adding the global middleware
$app->add(new \App\Middleware\TrailingSlashMiddleware());
$app->add(new \App\Middleware\ContentTypeMiddleware());

// Registering the routes
require_once __DIR__ . '/../routes/app.php';