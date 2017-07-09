<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/23/17
 * Time: 9:33 PM
 */

namespace App\Database\Schemas\Tables;

abstract class SynonymSetsTable extends BaseTable {


    // Table name
    const TABLE_NAME = 'synonym_sets';

    // Columns
    const ID = 'id';
    const ID_DATA_TYPE = 'INT(11) UNSIGNED';

    const PART_OF_SPEECH_ID = 'part_of_speech_id';
    const PART_OF_SPEECH_ID_DATA_TYPE = 'TINYINT UNSIGNED';

    const DEFINITION = 'definition';
    const DEFINITION_DATA_TYPE = 'TEXT';


}