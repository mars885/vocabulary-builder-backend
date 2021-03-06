<?php

use App\Database\Queries\TableQueries;
use Phinx\Migration\AbstractMigration;

class CreatePartsOfSpeechTable extends AbstractMigration {




    public function up() {
        $this->execute(TableQueries::getPartsOfSpeechTableCreationQuery());
    }




    public function down() {
        $this->execute(TableQueries::getPartsOfSpeechTableDeletionQuery());
    }




}
