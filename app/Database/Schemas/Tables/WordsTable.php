<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 8/24/17
 * Time: 2:21 AM
 */

namespace App\Database\Schemas\Tables;

abstract class WordsTable extends BaseTable {


    // Table name
    const TABLE_NAME = 'words';

    // Columns
    const ID = 'id';
    const ID_DATA_TYPE = 'INT(11) UNSIGNED';

    const WORD = 'word';
    const WORD_DATA_TYPE = 'VARCHAR(100)';

    const AUDIO_FILE_PATH = 'audio_file_path';
    const AUDIO_FILE_PATH_DATA_TYPE = 'VARCHAR(100)';


}