<?php

use App\Database\Queries\TableQueries;
use App\Database\Queries\UtilityQueries;
use App\Database\Schemas\Tables\DictionaryTable;
use App\Utils\Utils;
use Phinx\Migration\AbstractMigration;

class PrepopulateDictionaryTable extends AbstractMigration {




    public function up() {
        $table = $this->table(DictionaryTable::TABLE_NAME);
        $table->insert(Utils::fetchDatabaseDataFromResources('dictionary.txt'));
        $table->saveData();
    }




    public function down() {
        $this->execute(UtilityQueries::getForeignKeyChecksDisablingQuery());
        $this->execute(TableQueries::getDictionaryTableTruncationQuery());
        $this->execute(UtilityQueries::getForeignKeyChecksEnablingQuery());
    }




}