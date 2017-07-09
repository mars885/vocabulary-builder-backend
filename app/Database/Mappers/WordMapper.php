<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/29/17
 * Time: 3:31 AM
 */

namespace App\Database\Mappers;

use App\Database\Binders\UserBinder;
use App\Database\Binders\WordBinder;
use App\Database\Extractors\WordExtractor;
use App\Database\Mappers\Interfaces\WordMapperInterface;
use App\Database\Queries\Concrete\WordQueries;
use PDO;

class WordMapper extends BaseMapper implements WordMapperInterface {




    /**
     * @param PDO $handler
     */
    public function __construct(PDO $handler) {
        parent::__construct($handler);
    }




    /**
     * @inheritdoc
     */
    public function search($parameters, $accentsConfig) {
        // Preparing the statement to be executed
        $statement = $this->prepareQuery(WordQueries::getWordsSearchingQuery($parameters));

        // Binding all the possible parameters
        WordBinder::bindWordParameter($statement, $parameters->getWord());
        WordBinder::bindPartOfSpeechParameter($statement, $parameters->getPartOfSpeech());
        UserBinder::bindUserIdParameter($statement, $parameters->getAuthUserId());

        // Executing the prepared statement
        if(!$this->executeStatement($statement)) {
            return null;
        }

        // Extracting a word and returning it
        return WordExtractor::extractWord($statement->fetchAll(), $accentsConfig);
    }




}