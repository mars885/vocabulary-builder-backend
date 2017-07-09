<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 11/19/17
 * Time: 12:20 AM
 */

namespace App\Database\Schemas\Tables;

abstract class PartsOfSpeechTable extends BaseTable {


    // Table name
    const TABLE_NAME = 'parts_of_speech';

    // Columns
    const ID = 'id';
    const ID_DATA_TYPE = 'TINYINT UNSIGNED';

    const PART_OF_SPEECH = 'part_of_speech';
    const PART_OF_SPEECH_DATA_TYPE = 'VARCHAR(15)';


}