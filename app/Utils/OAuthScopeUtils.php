<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/31/17
 * Time: 11:48 PM
 */

namespace App\Utils;

use App\Model\Constants\OAuthScopeDomains;
use App\Model\Constants\OAuthScopePermissions;
use App\Model\OAuthScope;

abstract class OAuthScopeUtils {




    /**
     * @param string $scope
     *
     * @return OAuthScope|null
     */
    public static function parseScope($scope) {
        // Exploding the scope to get detailed information about it
        $parts = ArrayUtils::explode(OAuthScope::PART_DELIMITER, $scope);

        // Checking whether the unneeded info is provided
        if(ArrayUtils::getSize($parts) !== 2) {
            return null;
        }

        // Checking whether the permission is valid
        if(!ArrayUtils::contains($parts[0], OAuthScopePermissions::getPermissionsAsArray())) {
            return null;
        }

        // Checking whether the domain is valid
        if(!ArrayUtils::contains($parts[1], OAuthScopeDomains::getDomainsAsArray())) {
            return null;
        }

        // Returning on success
        return (new OAuthScope())->setPermission($parts[0])->setDomain($parts[1]);
    }




    /**
     * @param string[] $rawScopes
     *
     * @return OAuthScope[]
     */
    public static function parseScopes($rawScopes) {
        $scopes = array();

        foreach($rawScopes as $rawScope) {
            $scopes[] = self::parseScope($rawScope);
        }

        return $scopes;
    }




}