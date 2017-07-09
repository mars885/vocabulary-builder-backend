<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/29/17
 * Time: 4:48 AM
 */

namespace App\Database\Mappers;

use App\Database\Binders\OAuthAccessTokenBinder;
use App\Database\Binders\OAuthRefreshTokenBinder;
use App\Database\Binders\OAuthTokenBinder;
use App\Database\Mappers\Interfaces\OAuthRefreshTokenMapperInterface;
use App\Database\Queries\Concrete\OAuthRefreshTokenQueries;
use App\Database\Schemas\Tables\OAuthAccessTokensTable;
use App\Database\Utils\CursorCommon;
use PDO;

class OAuthRefreshTokenMapper extends BaseMapper implements OAuthRefreshTokenMapperInterface {




    /**
     * @param PDO $handler
     */
    public function __construct(PDO $handler) {
        parent::__construct($handler);
    }




    /**
     * @inheritdoc
     */
    public function insertRefreshToken($parameters) {
        // Preparing the statement to be executed
        $statement = $this->prepareQuery(OAuthRefreshTokenQueries::getRefreshTokenInsertingQuery());

        // Binding the parameters
        OAuthRefreshTokenBinder::bindRefreshTokenIdParameter($statement, $parameters->getId());
        OAuthAccessTokenBinder::bindAccessTokenIdParameter($statement, $parameters->getAccessTokenId());
        OAuthTokenBinder::bindExpiryTimeParameter($statement, $parameters->getExpiryTime());

        // Executing the prepared statement
        $result = $statement->execute();

        // Returning the result
        return $result;
    }




    /**
     * @inheritdoc
     */
    public function revokeRefreshToken($parameters) {
        // Preparing the statement to be executed
        $statement = $this->prepareQuery(OAuthRefreshTokenQueries::getRefreshTokenRevokingQuery());

        // Binding the parameters
        OAuthRefreshTokenBinder::bindRefreshTokenIdParameter($statement, $parameters->getId());
        OAuthTokenBinder::bindIsRevokedParameter($statement, $parameters->isRevoked());

        // Executing the prepared statement
        $result = $statement->execute();

        // Returning the result
        return $result;
    }




    /**
     * @inheritdoc
     */
    public function isRefreshTokenRevoked($parameters) {
        // Preparing the statement to be executed
        $statement = $this->prepareQuery(OAuthRefreshTokenQueries::getIsRefreshTokenRevokedQuery());

        // Binding the parameters
        OAuthRefreshTokenBinder::bindRefreshTokenIdParameter($statement, $parameters->getId());

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