<?php

use App\Database\Queries\TableQueries;
use Phinx\Migration\AbstractMigration;

class CreateUserLikedDictionaryEntriesTable extends AbstractMigration {




    public function up() {
        $this->execute(TableQueries::getUserLikedDictionaryEntriesTableCreationQuery());
    }




    public function down() {
        $this->execute(TableQueries::getUserLikedDictionaryEntriesTableDeletionQuery());
    }




}
