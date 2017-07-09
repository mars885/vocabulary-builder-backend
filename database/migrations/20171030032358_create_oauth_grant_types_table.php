<?php

use App\Database\Queries\TableQueries;
use Phinx\Migration\AbstractMigration;

class CreateOauthGrantTypesTable extends AbstractMigration {




    public function up() {
        $this->execute(TableQueries::getOAuthGrantTypesTableCreationQuery());
    }




    public function down() {
        $this->execute(TableQueries::getOAuthGrantTypesTableDeletionQuery());
    }




}
