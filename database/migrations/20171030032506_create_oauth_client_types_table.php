<?php

use App\Database\Queries\TableQueries;
use Phinx\Migration\AbstractMigration;

class CreateOauthClientTypesTable extends AbstractMigration {




    public function up() {
        $this->execute(TableQueries::getOAuthClientTypesTableCreationQuery());
    }




    public function down() {
        $this->execute(TableQueries::getOAuthClientTypesTableDeletionQuery());
    }




}
