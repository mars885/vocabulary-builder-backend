<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/29/17
 * Time: 11:46 PM
 */

namespace App\Database\Queries\Concrete;

use App\Database\Placeholders\OAuthAccessTokenPlaceholders;
use App\Database\Placeholders\OAuthClientPlaceholders;
use App\Database\Placeholders\OAuthTokenPlaceholders;
use App\Database\Schemas\Tables\OAuthAccessTokensTable;
use App\Database\Schemas\Tables\OAuthOwnerTypesTable;

abstract class OAuthAccessTokenQueries {




    /**
     * @return string
     */
    public static function getAccessTokenInsertingQuery() {
        return
            'INSERT INTO '
            . OAuthAccessTokensTable::TABLE_NAME
            . ' ('
            . OAuthAccessTokensTable::ID
            . ', '
            . OAuthAccessTokensTable::CLIENT_ID
            . ', '
            . OAuthAccessTokensTable::OWNER_TYPE_ID
            . ', '
            . OAuthAccessTokensTable::OWNER_ID
            . ', '
            . OAuthAccessTokensTable::EXPIRE_TIME
            . ') VALUES ('
            . OAuthAccessTokenPlaceholders::ACCESS_TOKEN_ID
            . ', '
            . OAuthClientPlaceholders::CLIENT_ID
            . ', (SELECT '
            . OAuthOwnerTypesTable::ID
            . ' FROM '
            . OAuthOwnerTypesTable::TABLE_NAME
            . ' WHERE '
            . OAuthOwnerTypesTable::TYPE
            . ' = '
            . OAuthAccessTokenPlaceholders::OWNER_TYPE
            . '), '
            . OAuthAccessTokenPlaceholders::OWNER_ID
            . ', '
            . OAuthTokenPlaceholders::EXPIRY_TIME
            . ')'
        ;
    }




    /**
     * @return string
     */
    public static function getAccessTokenRevokingQuery() {
        return
            'UPDATE '
            . OAuthAccessTokensTable::TABLE_NAME
            . ' SET '
            . OAuthAccessTokensTable::IS_REVOKED
            . ' = '
            . OAuthTokenPlaceholders::IS_REVOKED
            . ' WHERE '
            . OAuthAccessTokensTable::ID
            . ' = '
            . OAuthAccessTokenPlaceholders::ACCESS_TOKEN_ID
        ;
    }




    /**
     * @return string
     */
    public static function getIsAccessTokenRevokedQuery() {
        return
            'SELECT '
            . OAuthAccessTokensTable::IS_REVOKED
            . ' FROM '
            . OAuthAccessTokensTable::TABLE_NAME
            . ' WHERE '
            . OAuthAccessTokensTable::ID
            . ' = '
            . OAuthAccessTokenPlaceholders::ACCESS_TOKEN_ID
        ;
    }




}