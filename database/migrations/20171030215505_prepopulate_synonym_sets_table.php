<?php

use App\Database\Queries\TableQueries;
use App\Database\Queries\UtilityQueries;
use App\Database\Schemas\Tables\SynonymSetsTable;
use App\Utils\Utils;
use Phinx\Migration\AbstractMigration;

class PrepopulateSynonymSetsTable extends AbstractMigration {




    public function up() {
        $table = $this->table(SynonymSetsTable::TABLE_NAME);
        $table->insert(Utils::fetchDatabaseDataFromResources('synonym_sets.txt'));
        $table->saveData();
    }




    public function down() {
        $this->execute(UtilityQueries::getForeignKeyChecksDisablingQuery());
        $this->execute(TableQueries::getSynonymSetsTableTruncationQuery());
        $this->execute(UtilityQueries::getForeignKeyChecksEnablingQuery());
    }




}
