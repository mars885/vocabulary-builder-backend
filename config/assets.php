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
     * Assets Base Url
     *----------------------------------------------------------------
     *
     * This value determines the base url of the assets. May be on
     * another server or on the same as this app.
     *
     */

    'url' => getenv('ASSETS_BASE_URL'),


    /*
     *----------------------------------------------------------------
     * Pronunciation Audio
     *----------------------------------------------------------------
     *
     * The pronunciation audio assets related configurations go here.
     *
     */

    'pronunciation_audio' => [


        /*
         *----------------------------------------------------------------
         * Audio Assets Base Url
         *----------------------------------------------------------------
         *
         * This value determines the base url of audio assets.
         *
         */

        'url' => getenv('PRONUNCIATION_AUDIO_BASE_URL'),


        /*
         *----------------------------------------------------------------
         * Accents
         *----------------------------------------------------------------
         *
         * The accents related configurations go here.
         *
         */

        'accents' => [


            /*
             *----------------------------------------------------------------
             * American Pronunciations Url
             *----------------------------------------------------------------
             *
             * This value determines the base url of the american pronunciations.
             *
             */

            'us' => getenv('US_PRONUNCIATION_AUDIO_BASE_URL'),


            /*
             *----------------------------------------------------------------
             * British Pronunciations Url
             *----------------------------------------------------------------
             *
             * This value determines the base url of the british pronunciations.
             *
             */

            'gb' => getenv('GB_PRONUNCIATION_AUDIO_BASE_URL'),


            /*
             *----------------------------------------------------------------
             * Australian Pronunciations Url
             *----------------------------------------------------------------
             *
             * This value determines the base url of the australian pronunciations.
             *
             */

            'au' => getenv('AU_PRONUNCIATION_AUDIO_BASE_URL'),


        ]


    ],


    /*
     *----------------------------------------------------------------
     * Images
     *----------------------------------------------------------------
     *
     * The images related configurations go here.
     *
     */

    'images' => [


        /*
         *----------------------------------------------------------------
         * Images Assets Base Url
         *----------------------------------------------------------------
         *
         * This value determines the base url of image assets.
         *
         */

        'url' => getenv('IMAGES_BASE_URL'),


        /*
         *----------------------------------------------------------------
         * Users
         *----------------------------------------------------------------
         *
         * The users related configurations go here.
         *
         */

        'users' => [


            /*
             *----------------------------------------------------------------
             * Users Images Url
             *----------------------------------------------------------------
             *
             * This value determines the base url of the images related to users.
             *
             */

            'url' => getenv('USER_IMAGES_BASE_URL'),


        ],


        /*
         *----------------------------------------------------------------
         * Client Logos
         *----------------------------------------------------------------
         *
         * The client logos related configurations go here.
         *
         */

        'client_logos' => [


            /*
             *----------------------------------------------------------------
             * Client Logos Url
             *----------------------------------------------------------------
             *
             * This value determines the base url of the client logos.
             *
             */

            'url' => getenv('CLIENT_LOGO_IMAGES_BASE_URL'),


        ]


    ]


];