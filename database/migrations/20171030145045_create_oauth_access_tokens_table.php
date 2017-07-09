<?php

use App\Database\Queries\TableQueries;
use Phinx\Migration\AbstractMigration;

class CreateOauthAccessTokensTable extends AbstractMigration {




    public function up() {
        $this->execute(TableQueries::getOAuthAccessTokensTableCreationQuery());
    }




    public function down() {
        $this->execute(TableQueries::getOAuthAccessTokensTableDeletionQuery());
    }




}
