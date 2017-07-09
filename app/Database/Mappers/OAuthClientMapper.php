<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/29/17
 * Time: 3:59 AM
 */

namespace App\Database\Mappers;

use App\Database\Binders\OAuthClientBinder;
use App\Database\Binders\OAuthGrantBinder;
use App\Database\Extractors\OAuthClientExtractor;
use App\Database\Mappers\Interfaces\OAuthClientMapperInterface;
use App\Database\Queries\Concrete\OAuthClientQueries;
use PDO;

class OAuthClientMapper extends BaseMapper implements OAuthClientMapperInterface {




    /**
     * @param PDO $handler
     */
    public function __construct(PDO $handler) {
        parent::__construct($handler);
    }




    /**
     * @inheritdoc
     */
    public function getClientByIdAndGrantType($parameters) {
        // Preparing the statement to be executed
        $statement = $this->prepareQuery(OAuthClientQueries::getClientByIdAndGrantTypeFetchingQuery());

        // Binding the parameters
        OAuthClientBinder::bindClientIdParameter($statement, $parameters->getClientId());
        OAuthGrantBinder::bindGrantTypeParameter($statement, $parameters->getGrantType());

        // Executing the prepared statement
        if(!$this->executeStatement($statement)) {
            return null;
        }

        // Extracting a client and returning it
        return OAuthClientExtractor::extractClient($statement->fetch());
    }




}