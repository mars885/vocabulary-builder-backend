<?php

use App\Database\Queries\TableQueries;
use Phinx\Migration\AbstractMigration;

class CreateOauthOwnerTypesTable extends AbstractMigration {




    public function up() {
        $this->execute(TableQueries::getOAuthOwnerTypesTableCreationQuery());
    }




    public function down() {
        $this->execute(TableQueries::getOAuthOwnerTypesTableDeletionQuery());
    }




}
