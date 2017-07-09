<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/15/17
 * Time: 2:14 PM
 */

return [


    /*
     *----------------------------------------------------------------
     * Slim Framework Error Details
     *----------------------------------------------------------------
     *
     * This value determines whether to show error details or not.
     * Usually, set to true when on development server. When on
     * deployment server, set to false.
     *
     */

    'displayErrorDetails' => filter_var(getenv('APP_DEBUG'), FILTER_VALIDATE_BOOLEAN),


    /*
     *----------------------------------------------------------------
     * Slim Framework Cache
     *----------------------------------------------------------------
     *
     * This value determines the path of the cache file for the Slim's
     * router.
     *
     */

    //'routerCacheFile' => '', // todo


    /*
     *----------------------------------------------------------------
     * Application Environment
     *----------------------------------------------------------------
     *
     * This value determines the "environment" your application is
     * currently running in. This may determine how you prefer
     * to configure various services your application utilizes.
     * Set this in your ".env" file.
     *
     */

    'env' => getenv('APP_ENV'),


    /*
     *----------------------------------------------------------------
     * Application Debug Mode
     *----------------------------------------------------------------
     *
     * When your application is in debug mode, detailed error messages
     * with stack traces will be shown on every error that occurs
     * within your application. If disabled, a simple generic error
     * page is shown.
     *
     */

    'debug' => filter_var(getenv('APP_DEBUG'), FILTER_VALIDATE_BOOLEAN),


    /*
     *----------------------------------------------------------------
     * Application Url
     *----------------------------------------------------------------
     *
     * This value determines the url of your application. Useful for
     * in-app use whenever the base url is required.
     *
     */

    'url' => getenv('APP_URL'),


    /*
     *----------------------------------------------------------------
     * Application Keys
     *----------------------------------------------------------------
     *
     * The application keys related configurations go here.
     *
     */

    'keys' => require_once __DIR__ . '/keys.php',


    /*
     *----------------------------------------------------------------
     * Application Database
     *----------------------------------------------------------------
     *
     * The application database related configurations go here.
     *
     */

    'database' => require_once __DIR__ . '/database.php',


    /*
     *----------------------------------------------------------------
     * Application Pagination
     *----------------------------------------------------------------
     *
     * The application pagination related configurations go here.
     *
     */

    'pagination' => require_once __DIR__ . '/pagination.php',


    /*
     *----------------------------------------------------------------
     * Application Assets
     *----------------------------------------------------------------
     *
     * The application assets related configurations go here.
     *
     */

    'assets' => require_once __DIR__ . '/assets.php',


    /*
     *----------------------------------------------------------------
     * Application Authorization
     *----------------------------------------------------------------
     *
     * The application authorization related configurations go here.
     *
     */

    'oauth2' => require_once __DIR__ . '/oauth2.php'


];