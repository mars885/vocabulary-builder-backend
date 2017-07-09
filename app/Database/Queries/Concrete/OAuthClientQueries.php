<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/29/17
 * Time: 11:52 PM
 */

namespace App\Database\Queries\Concrete;

use App\Database\Aliases\ColumnAliases;
use App\Database\Aliases\TableAliases;
use App\Database\Placeholders\OAuthClientPlaceholders;
use App\Database\Placeholders\OAuthGrantPlaceholders;
use App\Database\Schemas\Tables\OAuthClientEndpointsTable;
use App\Database\Schemas\Tables\OAuthClientGrantTypesTable;
use App\Database\Schemas\Tables\OAuthClientsTable;
use App\Database\Schemas\Tables\OAuthGrantTypesTable;
use App\Database\Utils\QueryUtil;
use App\Model\Constants\Delimiters;

abstract class OAuthClientQueries {




    /**
     * @return string
     */
    public static function getClientByIdAndGrantTypeFetchingQuery() {
        return
            'SELECT '
            . QueryUtil::asTableAlias(TableAliases::OAUTH_CLIENTS_1, OAuthClientsTable::ID)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::OAUTH_CLIENTS_1, OAuthClientsTable::SECRET)
            . ', GROUP_CONCAT('
            . QueryUtil::asTableAlias(TableAliases::OAUTH_CLIENT_ENDPOINTS_1, OAuthClientEndpointsTable::REDIRECT_URL)
            . ' SEPARATOR \''
            . Delimiters::DELIMITER_REDIRECT_URLS
            . '\') '
            . QueryUtil::asAlias(ColumnAliases::REDIRECT_URLS)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::OAUTH_CLIENTS_1, OAuthClientsTable::IS_FIRST_PARTY)
            . ' FROM '
            . OAuthClientsTable::TABLE_NAME
            . ' '
            . QueryUtil::asAlias(TableAliases::OAUTH_CLIENTS_1)
            . ' LEFT JOIN '
            . OAuthClientEndpointsTable::TABLE_NAME
            . ' '
            . QueryUtil::asAlias(TableAliases::OAUTH_CLIENT_ENDPOINTS_1)
            . ' ON '
            . QueryUtil::asTableAlias(TableAliases::OAUTH_CLIENTS_1, OAuthClientsTable::ID)
            . ' = '
            . QueryUtil::asTableAlias(TableAliases::OAUTH_CLIENT_ENDPOINTS_1, OAuthClientEndpointsTable::CLIENT_ID)
            . ' INNER JOIN '
            . OAuthClientGrantTypesTable::TABLE_NAME
            . ' '
            . QueryUtil::asAlias(TableAliases::OAUTH_CLIENT_GRANT_TYPES_1)
            . ' ON '
            . QueryUtil::asTableAlias(TableAliases::OAUTH_CLIENTS_1, OAuthClientsTable::ID)
            . ' = '
            . QueryUtil::asTableAlias(TableAliases::OAUTH_CLIENT_GRANT_TYPES_1, OAuthClientGrantTypesTable::CLIENT_ID)
            . ' INNER JOIN '
            . OAuthGrantTypesTable::TABLE_NAME
            . ' '
            . QueryUtil::asAlias(TableAliases::OAUTH_GRANT_TYPES_1)
            . ' ON '
            . QueryUtil::asTableAlias(TableAliases::OAUTH_CLIENT_GRANT_TYPES_1, OAuthClientGrantTypesTable::GRANT_TYPE_ID)
            . ' = '
            . QueryUtil::asTableAlias(TableAliases::OAUTH_GRANT_TYPES_1, OAuthGrantTypesTable::ID)
            . ' WHERE '
            . QueryUtil::asTableAlias(TableAliases::OAUTH_CLIENTS_1, OAuthClientsTable::ID)
            . ' = '
            . OAuthClientPlaceholders::CLIENT_ID
            . ' AND '
            . QueryUtil::asTableAlias(TableAliases::OAUTH_GRANT_TYPES_1, OAuthGrantTypesTable::TYPE)
            . ' = '
            . OAuthGrantPlaceholders::GRANT_TYPE
            . ' GROUP BY '
            . QueryUtil::asTableAlias(TableAliases::OAUTH_CLIENTS_1, OAuthClientsTable::ID)
        ;
    }




}