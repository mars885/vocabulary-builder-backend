<?php

use App\Database\Queries\TableQueries;
use Phinx\Migration\AbstractMigration;

class CreateOauthClientGrantTypesTable extends AbstractMigration {




    public function up() {
        $this->execute(TableQueries::getOAuthClientGrantTypesTableCreationQuery());
    }




    public function down() {
        $this->execute(TableQueries::getOAuthClientGrantTypesTableDeletionQuery());
    }




}
