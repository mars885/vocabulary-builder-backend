<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/7/17
 * Time: 4:37 AM
 */

namespace App\Database\Schemas\Tables;

abstract class DictionaryTable extends BaseTable {


    // Table name
    const TABLE_NAME = 'dictionary';

    // Columns
    const ID = 'id';
    const ID_DATA_TYPE = 'INT(11) UNSIGNED';

    const WORD_ID = 'word_id';
    const WORD_ID_DATA_TYPE = 'INT(11) UNSIGNED';

    const SYNONYM_SET_ID = 'synonym_set_id';
    const SYNONYM_SET_ID_DATA_TYPE = 'INT(11) UNSIGNED';

    const CASED = 'cased';
    const CASED_DATA_TYPE = 'VARCHAR(100)';

    const EXAMPLES = 'examples';
    const EXAMPlES_DATA_TYPE = 'TEXT';

    const SYNONYMS = 'synonyms';
    const SYNONYMS_DATA_TYPE = 'TEXT';

    const ANTONYMS = 'antonyms';
    const ANTONYMS_DATA_TYPE = 'TEXT';

    const DERIVATIONS = 'derivations';
    const DERIVATIONS_DATA_TYPE = 'TEXT';

    const LEARNER_COUNT = 'learner_count';
    const LEARNER_COUNT_DATA_TYPE = 'INT(11) UNSIGNED';

    const MASTER_COUNT = 'master_count';
    const MASTER_COUNT_DATA_TYPE = 'INT(11) UNSIGNED';

    const LIKE_COUNT = 'like_count';
    const LIkE_COUNT_DATA_TYPE = 'INT(11) UNSIGNED';


}