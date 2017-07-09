<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/29/17
 * Time: 11:46 PM
 */

namespace App\Database\Queries\Concrete;

use App\Database\Placeholders\OAuthAccessTokenPlaceholders;
use App\Database\Placeholders\OAuthRefreshTokenPlaceholders;
use App\Database\Placeholders\OAuthTokenPlaceholders;
use App\Database\Schemas\Tables\OAuthRefreshTokensTable;

abstract class OAuthRefreshTokenQueries {




    /**
     * @return string
     */
    public static function getRefreshTokenInsertingQuery() {
        return
            'INSERT INTO '
            . OAuthRefreshTokensTable::TABLE_NAME
            . ' ('
            . OAuthRefreshTokensTable::ID
            . ', '
            . OAuthRefreshTokensTable::ACCESS_TOKEN_ID
            . ', '
            . OAuthRefreshTokensTable::EXPIRE_TIME
            . ') VALUES ('
            . OAuthRefreshTokenPlaceholders::REFRESH_TOKEN_ID
            . ', '
            . OAuthAccessTokenPlaceholders::ACCESS_TOKEN_ID
            . ', '
            . OAuthTokenPlaceholders::EXPIRY_TIME
            . ')'
        ;
    }




    /**
     * @return string
     */
    public static function getRefreshTokenRevokingQuery() {
        return
            'UPDATE '
            . OAuthRefreshTokensTable::TABLE_NAME
            . ' SET '
            . OAuthRefreshTokensTable::IS_REVOKED
            . ' = '
            . OAuthTokenPlaceholders::IS_REVOKED
            . ' WHERE '
            . OAuthRefreshTokensTable::ID
            . ' = '
            . OAuthRefreshTokenPlaceholders::REFRESH_TOKEN_ID
        ;
    }




    /**
     * @return string
     */
    public static function getIsRefreshTokenRevokedQuery() {
        return
            'SELECT '
            . OAuthRefreshTokensTable::IS_REVOKED
            . ' FROM '
            . OAuthRefreshTokensTable::TABLE_NAME
            . ' WHERE '
            . OAuthRefreshTokensTable::ID
            . ' = '
            . OAuthRefreshTokenPlaceholders::REFRESH_TOKEN_ID
        ;
    }




}