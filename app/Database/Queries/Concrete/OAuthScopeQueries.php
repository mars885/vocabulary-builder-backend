<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/29/17
 * Time: 11:50 PM
 */

namespace App\Database\Queries\Concrete;

use App\Database\Aliases\TableAliases;
use App\Database\Placeholders\OAuthClientPlaceholders;
use App\Database\Placeholders\OAuthGrantPlaceholders;
use App\Database\Placeholders\OAuthScopePlaceholders;
use App\Database\Schemas\Tables\OAuthClientScopesTable;
use App\Database\Schemas\Tables\OAuthGrantTypeScopesTable;
use App\Database\Schemas\Tables\OAuthGrantTypesTable;
use App\Database\Schemas\Tables\OAuthScopeDomainsTable;
use App\Database\Schemas\Tables\OAuthScopePermissionsTable;
use App\Database\Schemas\Tables\OAuthScopesTable;
use App\Database\Utils\QueryUtil;

abstract class OAuthScopeQueries {




    /**
     * @return string
     */
    public static function getOAuthScopeForClientFetchingQuery() {
        return
            'SELECT '
            . QueryUtil::asTableAlias(TableAliases::OAUTH_SCOPES_1, OAuthScopesTable::ID)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::OAUTH_SCOPE_PERMISSIONS_1, OAuthScopePermissionsTable::PERMISSION)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::OAUTH_SCOPE_DOMAINS_1, OAuthScopeDomainsTable::DOMAIN)
            . ' FROM '
            . OAuthScopesTable::TABLE_NAME
            . ' '
            . QueryUtil::asAlias(TableAliases::OAUTH_SCOPES_1)
            . ' INNER JOIN '
            . OAuthScopePermissionsTable::TABLE_NAME
            . ' '
            . QueryUtil::asAlias(TableAliases::OAUTH_SCOPE_PERMISSIONS_1)
            . ' ON '
            . QueryUtil::asTableAlias(TableAliases::OAUTH_SCOPES_1, OAuthScopesTable::PERMISSION_ID)
            . ' = '
            . QueryUtil::asTableAlias(TableAliases::OAUTH_SCOPE_PERMISSIONS_1, OAuthScopePermissionsTable::ID)
            . ' INNER JOIN '
            . OAuthScopeDomainsTable::TABLE_NAME
            . ' '
            . QueryUtil::asAlias(TableAliases::OAUTH_SCOPE_DOMAINS_1)
            . ' ON '
            . QueryUtil::asTableAlias(TableAliases::OAUTH_SCOPES_1, OAuthScopesTable::DOMAIN_ID)
            . ' = '
            . QueryUtil::asTableAlias(TableAliases::OAUTH_SCOPE_DOMAINS_1, OAuthScopeDomainsTable::ID)
            . ' INNER JOIN '
            . OAuthClientScopesTable::TABLE_NAME
            . ' '
            . QueryUtil::asAlias(TableAliases::OAUTH_CLIENT_SCOPES_1)
            . ' ON '
            . QueryUtil::asTableAlias(TableAliases::OAUTH_SCOPES_1, OAuthScopesTable::ID)
            . ' = '
            . QueryUtil::asTableAlias(TableAliases::OAUTH_CLIENT_SCOPES_1, OAuthClientScopesTable::SCOPE_ID)
            . ' INNER JOIN '
            . OAuthGrantTypeScopesTable::TABLE_NAME
            . ' '
            . QueryUtil::asAlias(TableAliases::OAUTH_GRANT_TYPE_SCOPES_1)
            . ' ON '
            . QueryUtil::asTableAlias(TableAliases::OAUTH_SCOPES_1, OAuthScopesTable::ID)
            . ' = '
            . QueryUtil::asTableAlias(TableAliases::OAUTH_GRANT_TYPE_SCOPES_1, OAuthGrantTypeScopesTable::SCOPE_ID)
            . ' INNER JOIN '
            . OAuthGrantTypesTable::TABLE_NAME
            . ' '
            . QueryUtil::asAlias(TableAliases::OAUTH_GRANT_TYPES_1)
            . ' ON '
            . QueryUtil::asTableAlias(TableAliases::OAUTH_GRANT_TYPE_SCOPES_1, OAuthGrantTypeScopesTable::GRANT_TYPE_ID)
            . ' = '
            . QueryUtil::asTableAlias(TableAliases::OAUTH_GRANT_TYPES_1, OAuthGrantTypesTable::ID)
            . ' WHERE '
            . QueryUtil::asTableAlias(TableAliases::OAUTH_SCOPE_PERMISSIONS_1, OAuthScopePermissionsTable::PERMISSION)
            . ' = '
            . OAuthScopePlaceholders::PERMISSION
            . ' AND '
            . QueryUtil::asTableAlias(TableAliases::OAUTH_SCOPE_DOMAINS_1, OAuthScopeDomainsTable::DOMAIN)
            . ' = '
            . OAuthScopePlaceholders::DOMAIN
            . ' AND '
            . QueryUtil::asTableAlias(TableAliases::OAUTH_CLIENT_SCOPES_1, OAuthClientScopesTable::CLIENT_ID)
            . ' = '
            . OAuthClientPlaceholders::CLIENT_ID
            . ' AND '
            . QueryUtil::asTableAlias(TableAliases::OAUTH_GRANT_TYPES_1, OAuthGrantTypesTable::TYPE)
            . ' = '
            . OAuthGrantPlaceholders::GRANT_TYPE
        ;
    }




}