<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/15/17
 * Time: 10:54 PM
 */

namespace App\Repositories;

use App\Repositories\Interfaces\OAuthAuthCodeRepositoryInterface;
use Interop\Container\ContainerInterface;

class OAuthAuthCodeRepository extends BaseRepository implements OAuthAuthCodeRepositoryInterface {




    /**
     * @param ContainerInterface $container
     */
    public function __construct($container) {
        parent::__construct($container);
    }




    /**
     * {@inheritdoc}
     */
    public function getNewAuthCode() {
        // TODO: Implement getNewAuthCode() method.
    }




    /**
     * {@inheritdoc}
     */
    public function persistNewAuthCode($authCode) {
        // TODO: Implement persistNewAuthCode() method.
    }




    /**
     * {@inheritdoc}
     */
    public function revokeAuthCode($codeId) {
        // TODO: Implement revokeAuthCode() method.
    }




    /**
     * {@inheritdoc}
     */
    public function isAuthCodeRevoked($codeId) {
        // TODO: Implement isAuthCodeRevoked() method.
    }




}