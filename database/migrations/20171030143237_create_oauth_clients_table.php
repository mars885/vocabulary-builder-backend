<?php

use App\Database\Queries\TableQueries;
use Phinx\Migration\AbstractMigration;

class CreateOauthClientsTable extends AbstractMigration {




    public function up() {
        $this->execute(TableQueries::getOAuthClientsTableCreationQuery());
    }




    public function down() {
        $this->execute(TableQueries::getOAuthClientsTableDeletionQuery());
    }




}
