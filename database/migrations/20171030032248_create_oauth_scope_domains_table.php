<?php

use App\Database\Queries\TableQueries;
use Phinx\Migration\AbstractMigration;

class CreateOauthScopeDomainsTable extends AbstractMigration {




    public function up() {
        $this->execute(TableQueries::getOAuthScopeDomainsTableCreationQuery());
    }




    public function down() {
        $this->execute(TableQueries::getOAuthScopeDomainsTableDeletionQuery());
    }




}
