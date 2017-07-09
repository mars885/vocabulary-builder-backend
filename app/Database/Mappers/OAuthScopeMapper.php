<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/29/17
 * Time: 4:18 AM
 */

namespace App\Database\Mappers;

use App\Database\Binders\OAuthClientBinder;
use App\Database\Binders\OAuthGrantBinder;
use App\Database\Binders\OAuthScopeBinder;
use App\Database\Extractors\OAuthScopeExtractor;
use App\Database\Mappers\Interfaces\OAuthScopeMapperInterface;
use App\Database\Queries\Concrete\OAuthScopeQueries;
use PDO;

class OAuthScopeMapper extends BaseMapper implements OAuthScopeMapperInterface {




    /**
     * @param PDO $handler
     */
    public function __construct(PDO $handler) {
        parent::__construct($handler);
    }




    /**
     * @inheritdoc
     */
    public function getScopeForClient($parameters) {
        // Preparing the statement to be executed
        $statement = $this->prepareQuery(OAuthScopeQueries::getOAuthScopeForClientFetchingQuery());

        // Binding the parameters
        OAuthScopeBinder::bindPermissionParameter($statement, $parameters->getPermission());
        OAuthScopeBinder::bindDomainParameter($statement, $parameters->getDomain());
        OAuthClientBinder::bindClientIdParameter($statement, $parameters->getClientId());
        OAuthGrantBinder::bindGrantTypeParameter($statement, $parameters->getGrantType());

        // Executing the prepared statement
        if(!$this->executeStatement($statement)) {
            return null;
        }

        // Extracting scope and returning it
        return OAuthScopeExtractor::extractScope($statement->fetch());
    }




}