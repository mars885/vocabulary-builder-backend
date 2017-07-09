<?php

use App\Database\Queries\TableQueries;
use Phinx\Migration\AbstractMigration;

class CreateUserDictionaryEntriesTable extends AbstractMigration {




    public function up() {
        $this->execute(TableQueries::getUserDictionaryEntriesTableCreationQuery());
    }




    public function down() {
        $this->execute(TableQueries::getUserDictionaryEntriesTableDeletionQuery());
    }




}
