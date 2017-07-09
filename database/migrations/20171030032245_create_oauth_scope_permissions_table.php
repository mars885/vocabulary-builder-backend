<?php

use App\Database\Queries\TableQueries;
use Phinx\Migration\AbstractMigration;

class CreateOauthScopePermissionsTable extends AbstractMigration {




    public function up() {
        $this->execute(TableQueries::getOAuthScopePermissionsTableCreationQuery());
    }




    public function down() {
        $this->execute(TableQueries::getOAuthScopePermissionsTableDeletionQuery());
    }




}
