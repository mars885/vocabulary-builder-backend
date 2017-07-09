<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/29/17
 * Time: 4:48 AM
 */

namespace App\Database\Mappers;

use App\Database\Binders\OAuthAccessTokenBinder;
use App\Database\Binders\OAuthClientBinder;
use App\Database\Binders\OAuthTokenBinder;
use App\Database\Mappers\Interfaces\OAuthAccessTokenMapperInterface;
use App\Database\Queries\Concrete\OAuthAccessTokenQueries;
use App\Database\Schemas\Tables\OAuthAccessTokensTable;
use App\Database\Utils\CursorCommon;
use PDO;

class OAuthAccessTokenMapper extends BaseMapper implements OAuthAccessTokenMapperInterface {




    /**
     * @param PDO $handler
     */
    public function __construct(PDO $handler) {
        parent::__construct($handler);
    }




    /**
     * @inheritdoc
     */
    public function insertAccessToken($parameters) {
        // Preparing the statement to be executed
        $statement = $this->prepareQuery(OAuthAccessTokenQueries::getAccessTokenInsertingQuery());

        // Binding the parameters
        OAuthAccessTokenBinder::bindAccessTokenIdParameter($statement, $parameters->getId());
        OAuthAccessTokenBinder::bindOwnerTypeParameter($statement, $parameters->getOwnerType());
        OAuthAccessTokenBinder::bindOwnerIdParameter($statement, $parameters->getOwnerId());
        OAuthTokenBinder::bindExpiryTimeParameter($statement, $parameters->getExpiryTime());
        OAuthClientBinder::bindClientIdParameter($statement, $parameters->getClientId());

        // Executing the prepared statement
        $result = $statement->execute();

        // Returning the result
        return $result;
    }




    /**
     * @inheritdoc
     */
    public function revokeAccessToken($parameters) {
        // Preparing the statement to be executed
        $statement = $this->prepareQuery(OAuthAccessTokenQueries::getAccessTokenRevokingQuery());

        // Binding the parameters
        OAuthAccessTokenBinder::bindAccessTokenIdParameter($statement, $parameters->getId());
        OAuthTokenBinder::bindIsRevokedParameter($statement, $parameters->isRevoked());

        // Executing the prepared statement
        $result = $statement->execute();

        // Returning the result
        return $result;
    }




    /**
     * @inheritdoc
     */
    public function isAccessTokenRevoked($parameters) {
        // Preparing the statement to be executed
        $statement = $this->prepareQuery(OAuthAccessTokenQueries::getIsAccessTokenRevokedQuery());

        // Binding the parameters
        OAuthAccessTokenBinder::bindAccessTokenIdParameter($statement, $parameters->getId());

        // Executing the prepared statement
        if(!$this->executeStatement($statement)) {
            return true;
        }

        // Fetching the result into an associative array
        $cursor = $statement->fetch();

        // Returning the result
        return CursorCommon::getBoolean($cursor, OAuthAccessTokensTable::IS_REVOKED);
    }




}