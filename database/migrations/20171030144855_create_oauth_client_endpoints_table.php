<?php

use App\Database\Queries\TableQueries;
use Phinx\Migration\AbstractMigration;

class CreateOauthClientEndpointsTable extends AbstractMigration {




    public function up() {
        $this->execute(TableQueries::getOAuthClientEndpointsTableCreationQuery());
    }




    public function down() {
        $this->execute(TableQueries::getOAuthClientEndpointsTableDeletionQuery());
    }




}
