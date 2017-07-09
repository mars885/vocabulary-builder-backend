<?php

use App\Database\Queries\TableQueries;
use Phinx\Migration\AbstractMigration;

class CreateWordsTable extends AbstractMigration {




    public function up() {
        $this->execute(TableQueries::getWordsTableCreationQuery());
    }




    public function down() {
        $this->execute(TableQueries::getWordsTableDeletionQuery());
    }




}
