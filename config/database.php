<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/15/17
 * Time: 2:14 PM
 */

return [


    /*
     *-------------------------------------------------------------------
     * Database Driver
     *-------------------------------------------------------------------
     *
     * This value determines the driver that is gonna be used by the
     * database in this app.
     *
     */

    'driver' => getenv('DB_DRIVER'),


    /*
     *-------------------------------------------------------------------
     * Database Host
     *-------------------------------------------------------------------
     *
     * This value determines the hostname on which the database server resides.
     *
     */

    'host' => getenv('DB_HOST'),


    /*
     *-------------------------------------------------------------------
     * Database Post
     *-------------------------------------------------------------------
     *
     * This value determines the port on which the database server listens on.
     *
     */

    'port' => intval(getenv('DB_PORT')),


    /*
     *-------------------------------------------------------------------
     * Database Name
     *-------------------------------------------------------------------
     *
     * This value determines the name of the database.
     *
     */

    'name' => getenv('DB_NAME'),


    /*
     *-------------------------------------------------------------------
     * Database Username
     *-------------------------------------------------------------------
     *
     * This value determines the user name of the database.
     *
     */

    'username' => getenv('DB_USERNAME'),


    /*
     *-------------------------------------------------------------------
     * Database Password
     *-------------------------------------------------------------------
     *
     * This value determines the password of the database.
     *
     */

    'password' => getenv('DB_PASSWORD'),


];