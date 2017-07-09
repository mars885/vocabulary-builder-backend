<?php

use App\Database\Queries\TableQueries;
use Phinx\Migration\AbstractMigration;

class CreateDictionaryTable extends AbstractMigration {




    public function up() {
        $this->execute(TableQueries::getDictionaryTableCreationQuery());
    }




    public function down() {
        $this->execute(TableQueries::getDictionaryTableDeletionQuery());
    }




}
