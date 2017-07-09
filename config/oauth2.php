<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/15/17
 * Time: 2:15 PM
 */

return [


    /*
     *-------------------------------------------------------------------
     * Time To Live (TTL)
     *-------------------------------------------------------------------
     *
     * The tokens TTL related configurations go here.
     *
     */

    'ttl' => [


        /*
         *-------------------------------------------------------------------
         * Authorization Code TTL
         *-------------------------------------------------------------------
         *
         * For how long the issued authorization code is valid (in seconds).
         *
         */

        'auth_code' => 60,  // 1 minute


        /*
         *-------------------------------------------------------------------
         * Access Token TTL
         *-------------------------------------------------------------------
         *
         * For how long the issued access token is valid (in seconds).
         *
         */

        'access' => 'P1Y',  // 3 hours


        /*
         *-------------------------------------------------------------------
         * Refresh Token TTL
         *-------------------------------------------------------------------
         *
         * For how long the issued refresh token is valid (in seconds).
         */

        'refresh' => 'P1Y3M',    // 30 days


    ],


    /*
     *-------------------------------------------------------------------
     * Scope Delimiter
     *-------------------------------------------------------------------
     *
     * Which character to use to split the scope parameter in the query
     * string.
     *
     */

    'scope_delimiter' => ','


];