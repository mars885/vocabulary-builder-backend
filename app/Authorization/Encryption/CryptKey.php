<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/15/17
 * Time: 7:05 PM
 */

namespace App\Authorization\Encryption;

use App\Utils\ArrayUtils;
use App\Utils\FileUtils;
use App\Utils\StringUtils;

class CryptKey {


    const RSA_KEY_PATTERN =
        '/^(-----BEGIN (RSA )?(PUBLIC|PRIVATE) KEY-----\n)(.|\n)+(-----END (RSA )?(PUBLIC|PRIVATE) KEY-----)$/';


    /**
     * @var string
     */
    private $keyPath;



    /**
     * @param string      $keyPath
     * @param bool        $keyPermissionsCheck
     */
    public function __construct($keyPath, $keyPermissionsCheck = true) {
        // Appending the schema (if necessary)
        if(!StringUtils::contains($keyPath, 'file://')) {
            $keyPath = 'file://' . $keyPath;
        }

        // Checking whether the path exists and if the file is readable
        if(!FileUtils::fileExists($keyPath) || !FileUtils::isFileReadable($keyPath)) {
            throw new \LogicException(sprintf(
                'Private key path "%s" does not exist or is not readable!',
                $keyPath
            ));
        }

        if($keyPermissionsCheck === true) {
            // Verify the permissions of the key
            $privateKeyPathPerms = decoct(FileUtils::getFilePermissions($keyPath) & 0777);

            // Checking whether the permissions are okay
            if (ArrayUtils::contains($privateKeyPathPerms, ['600', '660'], true) === false) {
                // todo
/*                trigger_error(sprintf(
                    'Key file "%s" permissions are not correct, should be 600 or 660 instead of %s',
                    $keyPath,
                    $privateKeyPathPerms
                ), E_USER_NOTICE);*/
            }
        }

        $this->keyPath = $keyPath;
    }




    /**
     * @return string
     */
    public function getKeyPath() {
        return $this->keyPath;
    }




}