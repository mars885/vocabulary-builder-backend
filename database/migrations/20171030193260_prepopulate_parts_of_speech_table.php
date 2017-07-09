<?php

use App\Database\Queries\TableQueries;
use App\Database\Queries\UtilityQueries;
use App\Database\Schemas\Tables\PartsOfSpeechTable;
use App\Model\Constants\PartsOfSpeech;
use Phinx\Migration\AbstractMigration;

class PrepopulatePartsOfSpeechTable extends AbstractMigration {




    public function up() {
        $table = $this->table(PartsOfSpeechTable::TABLE_NAME);

        $table->insert([
            [
                PartsOfSpeechTable::ID => PartsOfSpeech::ADJECTIVE_ID,
                PartsOfSpeechTable::PART_OF_SPEECH => PartsOfSpeech::ADJECTIVE
            ],
            [
                PartsOfSpeechTable::ID => PartsOfSpeech::ADVERB_ID,
                PartsOfSpeechTable::PART_OF_SPEECH => PartsOfSpeech::ADVERB
            ],
            [
                PartsOfSpeechTable::ID => PartsOfSpeech::NOUN_ID,
                PartsOfSpeechTable::PART_OF_SPEECH => PartsOfSpeech::NOUN
            ],
            [
                PartsOfSpeechTable::ID => PartsOfSpeech::VERB_ID,
                PartsOfSpeechTable::PART_OF_SPEECH => PartsOfSpeech::VERB
            ]
        ]);

        $table->saveData();
    }




    public function down() {
        $this->execute(UtilityQueries::getForeignKeyChecksDisablingQuery());
        $this->execute(TableQueries::getPartsOfSpeechTableTruncationQuery());
        $this->execute(UtilityQueries::getForeignKeyChecksEnablingQuery());
    }




}
