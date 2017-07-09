<?php

use App\Database\Queries\TableQueries;
use App\Database\Queries\UtilityQueries;
use App\Database\Schemas\Tables\WordsTable;
use App\Utils\Utils;
use Phinx\Migration\AbstractMigration;

class PrepopulateWordsTable extends AbstractMigration {




    public function up() {
        $table = $this->table(WordsTable::TABLE_NAME);
        $table->insert(Utils::fetchDatabaseDataFromResources('words.txt'));
        $table->saveData();
    }




    public function down() {
        $this->execute(UtilityQueries::getForeignKeyChecksDisablingQuery());
        $this->execute(TableQueries::getWordsTableTruncationQuery());
        $this->execute(UtilityQueries::getForeignKeyChecksEnablingQuery());
    }




}
