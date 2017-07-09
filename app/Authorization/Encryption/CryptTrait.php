<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/15/17
 * Time: 8:25 PM
 */

namespace App\Authorization\Encryption;

use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;

trait CryptTrait {


    /**
     * @var string
     */
    protected $encryptionKey;




    /**
     * Encrypt data with an encryption key.
     *
     * @param string $unencryptedData
     *
     * @throws \LogicException
     * @return string
     */
    protected function encrypt($unencryptedData) {
        try {
            return Crypto::encrypt($unencryptedData, Key::loadFromAsciiSafeString($this->encryptionKey));
        } catch(\Exception $exception) {
            throw new \LogicException($exception->getMessage());
        }
    }




    /**
     * Decrypt data with an encryption key.
     *
     * @param string $encryptedData
     *
     * @throws \LogicException
     * @return string
     */
    protected function decrypt($encryptedData) {
        try {
            return Crypto::decrypt($encryptedData, Key::loadFromAsciiSafeString($this->encryptionKey));
        } catch(\Exception $exception) {
            throw new \LogicException($exception->getMessage());
        }
    }



    /**
     * Set the encryption key.
     *
     * @param string $encryptionKey
     */
    public function setEncryptionKey($encryptionKey) {
        $this->encryptionKey = $encryptionKey;
    }




}