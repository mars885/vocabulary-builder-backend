<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/30/17
 * Time: 5:14 PM
 */

namespace App\Database\Extractors;

use App\Database\Schemas\Tables\OAuthScopeDomainsTable;
use App\Database\Schemas\Tables\OAuthScopePermissionsTable;
use App\Database\Schemas\Tables\OAuthScopesTable;
use App\Database\Utils\CursorCommon;
use App\Model\OAuthScope;
use App\Utils\Utils;

abstract class OAuthScopeExtractor {




    /**
     * @param OAuthScope $scope
     * @param array $cursor
     */
    public static function fillOutScope($scope, $cursor) {
        if(Utils::isNull($scope) || Utils::isInvalid($cursor)) {
            return;
        }

        // Filling out the object with cursor data
        $scope->setId(CursorCommon::getInt($cursor, OAuthScopesTable::ID));
        $scope->setPermission(CursorCommon::getString($cursor, OAuthScopePermissionsTable::PERMISSION));
        $scope->setDomain(CursorCommon::getString($cursor, OAuthScopeDomainsTable::DOMAIN));
        $scope->setDescription(CursorCommon::getString($cursor, OAuthScopesTable::DESCRIPTION));
    }




    /**
     * @param array $cursor
     *
     * @return OAuthScope|null
     */
    public static function extractScope($cursor) {
        $scopes = self::extractScopes([$cursor]);
        return (Utils::isNotNull($scopes) ? $scopes[0] : null);
    }




    /**
     * @param array $cursors
     *
     * @return OAuthScope[]|null
     */
    public static function extractScopes($cursors) {
        if(Utils::isInvalid($cursors)) {
            return null;
        }

        // Creating an array of OAuthScope objects
        $scopes = array();

        foreach($cursors as $cursor) {
            $scope = new OAuthScope();

            // Filling out the object with data
            self::fillOutScope($scope, $cursor);

            // Adding the scope to the array
            $scopes[] = $scope;
        }

        // Returning the array
        return $scopes;
    }




}