<?php

use App\Database\Queries\TableQueries;
use Phinx\Migration\AbstractMigration;

class CreateOauthRefreshTokensTable extends AbstractMigration {




    public function up() {
        $this->execute(TableQueries::getOAuthRefreshTokensTableCreationQuery());
    }




    public function down() {
        $this->execute(TableQueries::getOAuthRefreshTokensTableDeletionQuery());
    }




}
