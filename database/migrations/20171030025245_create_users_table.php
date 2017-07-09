<?php

use App\Database\Queries\TableQueries;
use Phinx\Migration\AbstractMigration;

class CreateUsersTable extends AbstractMigration {




    public function up() {
        $this->execute(TableQueries::getUsersTableCreationQuery());
    }




    public function down() {
        $this->execute(TableQueries::getUsersTableDeletionQuery());
    }




}