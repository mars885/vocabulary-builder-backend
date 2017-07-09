<?php

use App\Database\Queries\TableQueries;
use Phinx\Migration\AbstractMigration;

class CreateOauthScopesTable extends AbstractMigration {




    public function up() {
        $this->execute(TableQueries::getOAuthScopesTableCreationQuery());
    }




    public function down() {
        $this->execute(TableQueries::getOAuthScopesTableDeletionQuery());
    }




}