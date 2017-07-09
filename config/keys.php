<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/15/17
 * Time: 2:57 PM
 */

return [


    /*
     *-------------------------------------------------------------------
     * Private Key Path
     *-------------------------------------------------------------------
     *
     * This value determines the path to the private key on the server.
     *
     */

    'private' => getenv('PRIVATE_KEY_PATH'),


    /*
     *-------------------------------------------------------------------
     * Public Key Path
     *-------------------------------------------------------------------
     *
     * This value determines the path to the public key on the server.
     *
     */

    'public' => getenv('PUBLIC_KEY_PATH'),


    /*
     *-------------------------------------------------------------------
     * Encryption Key
     *-------------------------------------------------------------------
     *
     * This value determines the key used for encryption on this server.
     *
     */

    'encryption' => getenv('ENCRYPTION_KEY'),


];