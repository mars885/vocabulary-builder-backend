<?php

use App\Database\Queries\TableQueries;
use Phinx\Migration\AbstractMigration;

class CreateOauthGrantTypeScopesTable extends AbstractMigration {




    public function up() {
        $this->execute(TableQueries::getOAuthGrantTypeScopesTableCreationQuery());
    }




    public function down() {
        $this->execute(TableQueries::getOAuthGrantTypeScopesTableDeletionQuery());
    }




}
