<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/30/17
 * Time: 12:03 AM
 */

namespace App\Database\Extractors;

use App\Database\Aliases\ColumnAliases;
use App\Database\Schemas\Tables\BaseTable;
use App\Database\Schemas\Tables\DictionaryTable;
use App\Database\Schemas\Tables\PartsOfSpeechTable;
use App\Database\Schemas\Tables\SynonymSetsTable;
use App\Database\Schemas\Tables\WordsTable;
use App\Database\Utils\CursorCommon;
use App\Model\Constants\Delimiters;
use App\Model\Sense;
use App\Model\Word;
use App\Utils\ArrayUtils;
use App\Utils\Utils;

abstract class WordExtractor {




    /**
     * @param Word $word
     * @param Sense[] $senses
     * @param array $cursor
     * @param array $accentsConfig
     */
    public static function fillOutWord($word, $senses, $cursor, $accentsConfig) {
        if(Utils::isNull($word)
            || Utils::isInvalid($senses)
            || Utils::isInvalid($cursor)
            || Utils::isInvalid($accentsConfig)) {
            return;
        }

        // Filling out the object with cursor data
        $word->setId(CursorCommon::getInt($cursor, ColumnAliases::WORD_ID));
        $word->setWord(CursorCommon::getString($cursor, WordsTable::WORD));
        $word->setPronunciations(Utils::getAudioPronunciations(
            $accentsConfig,
            CursorCommon::getString($cursor, WordsTable::AUDIO_FILE_PATH)
        ));
        $word->setSenses($senses);
    }




    /**
     * @param Sense $sense
     * @param array $cursor
     */
    public static function fillOutSense($sense, $cursor) {
        if(Utils::isNull($sense) || Utils::isInvalid($cursor)) {
            return;
        }

        // Filling out the object with cursor data
        $sense->setId(CursorCommon::getInt($cursor, ColumnAliases::SENSE_ID));
        $sense->setCased(CursorCommon::getString($cursor, DictionaryTable::CASED));
        $sense->setCategory(CursorCommon::getString($cursor, ColumnAliases::CATEGORY));
        $sense->setPartOfSpeech(CursorCommon::getString($cursor, PartsOfSpeechTable::PART_OF_SPEECH));
        $sense->setDefinition(CursorCommon::getString($cursor, SynonymSetsTable::DEFINITION));
        $sense->setExamples(ArrayUtils::explode(
            Delimiters::DELIMITER_EXAMPLES,
            CursorCommon::getString($cursor, DictionaryTable::EXAMPLES)
        ));
        $sense->setSynonyms(ArrayUtils::explode(
            Delimiters::DELIMITER_SYNONYMS,
            CursorCommon::getString($cursor, DictionaryTable::SYNONYMS)
        ));
        $sense->setAntonyms(ArrayUtils::explode(
            Delimiters::DELIMITER_ANTONYMS,
            CursorCommon::getString($cursor, DictionaryTable::ANTONYMS)
        ));
        $sense->setDerivations(ArrayUtils::explode(
            Delimiters::DELIMITER_DERIVATIONS,
            CursorCommon::getString($cursor, DictionaryTable::DERIVATIONS)
        ));
        $sense->setLearnerCount(CursorCommon::getInt($cursor, DictionaryTable::LEARNER_COUNT));
        $sense->setMasterCount(CursorCommon::getInt($cursor, DictionaryTable::MASTER_COUNT));
        $sense->setLikeCount(CursorCommon::getInt($cursor, DictionaryTable::LIKE_COUNT));
        $sense->setLiked(CursorCommon::getBoolean($cursor, ColumnAliases::IS_LIKED));
        $sense->setCreatedAt(CursorCommon::getString($cursor, BaseTable::CREATED_AT));
        $sense->setUpdatedAt(CursorCommon::getString($cursor, BaseTable::UPDATED_AT));
    }




    /**
     * @param array $cursors
     *
     * @return Sense[]|null
     */
    public static function extractSenses($cursors) {
        if(Utils::isInvalid($cursors)) {
            return null;
        }

        // Creating an array of Sense objects
        $senses = array();

        foreach($cursors as $cursor) {
            $sense = new Sense();

            // Filling out the object with data
            self::fillOutSense($sense, $cursor);

            // Adding the sense to the array
            $senses[] = $sense;
        }

        // Returning the array
        return $senses;
    }




    /**
     * @param array $cursors
     * @param array $accentsConfig
     *
     * @return Word|null
     */
    public static function extractWord($cursors, $accentsConfig) {
        if(Utils::isInvalid($cursors)) {
            return null;
        }

        // Creating a Word object
        $word = new Word();

        // Filling out the word with data
        self::fillOutWord($word, self::extractSenses($cursors), $cursors[0], $accentsConfig);

        // Returning the word
        return $word;
    }




}