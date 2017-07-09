<?php

use App\Database\Queries\TableQueries;
use Phinx\Migration\AbstractMigration;

class CreateOauthClientScopesTable extends AbstractMigration {




    public function up() {
        $this->execute(TableQueries::getOAuthClientScopesTableCreationQuery());
    }




    public function down() {
        $this->execute(TableQueries::getOAuthClientScopesTableDeletionQuery());
    }




}
