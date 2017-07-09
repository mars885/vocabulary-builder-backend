<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/29/17
 * Time: 11:32 PM
 */

namespace App\Database\Queries\Concrete;

use App\Database\Aliases\ColumnAliases;
use App\Database\Aliases\TableAliases;
use App\Database\Placeholders\UserPlaceholders;
use App\Database\Placeholders\WordPlaceholders;
use App\Database\Schemas\Tables\DictionaryTable;
use App\Database\Schemas\Tables\PartsOfSpeechTable;
use App\Database\Schemas\Tables\SynonymSetsTable;
use App\Database\Schemas\Tables\UserDictionaryEntriesTable;
use App\Database\Schemas\Tables\UserLikedDictionaryEntriesTable;
use App\Database\Schemas\Tables\WordCategoriesTable;
use App\Database\Schemas\Tables\WordsTable;
use App\Database\Utils\QueryUtil;
use App\Model\Constants\WordCategories;
use App\Model\Parameters\WordParameters;

abstract class WordQueries {




    /**
     * @param WordParameters $parameters
     *
     * @return string
     */
    public static function getWordsSearchingQuery($parameters) {
        $query =
            'SELECT '
            . QueryUtil::asTableAlias(TableAliases::WORDS_1, WordsTable::ID)
            . ' '
            . QueryUtil::asAlias(ColumnAliases::WORD_ID)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::WORDS_1, WordsTable::WORD)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::WORDS_1, WordsTable::AUDIO_FILE_PATH)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::DICTIONARY_1, DictionaryTable::SYNONYM_SET_ID)
            . ' '
            . QueryUtil::asAlias(ColumnAliases::SENSE_ID)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::DICTIONARY_1, DictionaryTable::CASED)
            . ', IFNULL('
            . QueryUtil::asTableAlias(TableAliases::WORD_CATEGORIES_1, WordCategoriesTable::CATEGORY)
            . ', \''
            . WordCategories::NEW
            . '\') '
            . QueryUtil::asAlias(ColumnAliases::CATEGORY)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::PARTS_OF_SPEECH_1, PartsOfSpeechTable::PART_OF_SPEECH)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::SYNONYM_SETS_1, SynonymSetsTable::DEFINITION)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::DICTIONARY_1, DictionaryTable::EXAMPLES)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::DICTIONARY_1, DictionaryTable::SYNONYMS)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::DICTIONARY_1, DictionaryTable::ANTONYMS)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::DICTIONARY_1, DictionaryTable::DERIVATIONS)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::DICTIONARY_1, DictionaryTable::LEARNER_COUNT)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::DICTIONARY_1, DictionaryTable::MASTER_COUNT)
            . ', '
            . QueryUtil::asTableAlias(TableAliases::DICTIONARY_1, DictionaryTable::LIKE_COUNT)
            . ', IF('
            . QueryUtil::asTableAlias(TableAliases::USER_LIKED_DICTIONARY_ENTRIES_1, UserLikedDictionaryEntriesTable::USER_ID)
            . ' IS NULL, 0, 1) '
            . QueryUtil::asAlias(ColumnAliases::IS_LIKED)
            . ' FROM '
            . WordsTable::TABLE_NAME
            . ' '
            . QueryUtil::asAlias(TableAliases::WORDS_1)
            . ' INNER JOIN '
            . DictionaryTable::TABLE_NAME
            . ' '
            . QueryUtil::asAlias(TableAliases::DICTIONARY_1)
            . ' ON '
            . QueryUtil::asTableAlias(TableAliases::WORDS_1, WordsTable::ID)
            . ' = '
            . QueryUtil::asTableAlias(TableAliases::DICTIONARY_1, DictionaryTable::WORD_ID)
            . ' INNER JOIN '
            . SynonymSetsTable::TABLE_NAME
            . ' '
            . QueryUtil::asAlias(TableAliases::SYNONYM_SETS_1)
            . ' ON '
            . QueryUtil::asTableAlias(TableAliases::DICTIONARY_1, DictionaryTable::SYNONYM_SET_ID)
            . ' = '
            . QueryUtil::asTableAlias(TableAliases::SYNONYM_SETS_1, SynonymSetsTable::ID)
            . ' INNER JOIN '
            . PartsOfSpeechTable::TABLE_NAME
            . ' '
            . QueryUtil::asAlias(TableAliases::PARTS_OF_SPEECH_1)
            . ' ON '
            . QueryUtil::asTableAlias(TableAliases::SYNONYM_SETS_1, SynonymSetsTable::PART_OF_SPEECH_ID)
            . ' = '
            . QueryUtil::asTableAlias(TableAliases::PARTS_OF_SPEECH_1, PartsOfSpeechTable::ID)
            . ' LEFT JOIN '
            . UserDictionaryEntriesTable::TABLE_NAME
            . ' '
            . QueryUtil::asAlias(TableAliases::USER_DICTIONARY_ENTRIES_1)
            . ' ON '
            . QueryUtil::asTableAlias(TableAliases::USER_DICTIONARY_ENTRIES_1, UserDictionaryEntriesTable::USER_ID)
            . ' = '
            . UserPlaceholders::USER_ID
            . ' AND '
            . QueryUtil::asTableAlias(TableAliases::DICTIONARY_1, DictionaryTable::ID)
            . ' = '
            . QueryUtil::asTableAlias(TableAliases::USER_DICTIONARY_ENTRIES_1, UserDictionaryEntriesTable::DICTIONARY_ENTRY_ID)
            . ' LEFT JOIN '
            . WordCategoriesTable::TABLE_NAME
            . ' '
            . QueryUtil::asAlias(TableAliases::WORD_CATEGORIES_1)
            . ' ON '
            . QueryUtil::asTableAlias(TableAliases::USER_DICTIONARY_ENTRIES_1, UserDictionaryEntriesTable::WORD_CATEGORY_ID)
            . ' = '
            . QueryUtil::asTableAlias(TableAliases::WORD_CATEGORIES_1, WordCategoriesTable::ID)
            . ' LEFT JOIN '
            . UserLikedDictionaryEntriesTable::TABLE_NAME
            . ' '
            . QueryUtil::asAlias(TableAliases::USER_LIKED_DICTIONARY_ENTRIES_1)
            . ' ON '
            . QueryUtil::asTableAlias(TableAliases::USER_LIKED_DICTIONARY_ENTRIES_1, UserLikedDictionaryEntriesTable::USER_ID)
            . ' = '
            . UserPlaceholders::USER_ID
            . ' AND '
            . QueryUtil::asTableAlias(TableAliases::DICTIONARY_1, DictionaryTable::ID)
            . ' = '
            . QueryUtil::asTableAlias(TableAliases::USER_LIKED_DICTIONARY_ENTRIES_1, UserLikedDictionaryEntriesTable::DICTIONARY_ENTRY_ID)
            . ' WHERE '
            . WordsTable::WORD
            . ' = '
            . WordPlaceholders::WORD
        ;

        if($parameters->hasPartOfSpeech()) {
            $query .=
                ' AND '
                . QueryUtil::asTableAlias(TableAliases::PARTS_OF_SPEECH_1, PartsOfSpeechTable::PART_OF_SPEECH)
                . ' = '
                . WordPlaceholders::PART_OF_SPEECH
            ;
        }

        if($parameters->areExamplesRequired()) {
            $query .=
                ' AND '
                . QueryUtil::asTableAlias(TableAliases::DICTIONARY_1, DictionaryTable::EXAMPLES)
                . ' IS NOT NULL'
            ;
        }

        if($parameters->areSynonymsRequired()) {
            $query .=
                ' AND '
                . QueryUtil::asTableAlias(TableAliases::DICTIONARY_1, DictionaryTable::SYNONYMS)
                . ' IS NOT NULL'
            ;
        }

        if($parameters->areAntonymsRequired()) {
            $query .=
                ' AND '
                . QueryUtil::asTableAlias(TableAliases::DICTIONARY_1, DictionaryTable::ANTONYMS)
                . ' IS NOT NULL'
            ;
        }

        if($parameters->areDerivationsRequired()) {
            $query .=
                ' AND '
                . QueryUtil::asTableAlias(TableAliases::DICTIONARY_1, DictionaryTable::DERIVATIONS)
                . ' IS NOT NULL'
            ;
        }

        $query .=
            ' ORDER BY '
            . QueryUtil::asTableAlias(TableAliases::WORD_CATEGORIES_1, WordCategoriesTable::CATEGORY)
            . ' DESC, '
            . QueryUtil::asTableAlias(TableAliases::PARTS_OF_SPEECH_1, PartsOfSpeechTable::PART_OF_SPEECH)
            . ' ASC, '
            . QueryUtil::asTableAlias(TableAliases::DICTIONARY_1, DictionaryTable::SYNONYM_SET_ID)
            . ' ASC'
        ;

        return $query;
    }




}