<?php

use App\Database\Queries\TableQueries;
use Phinx\Migration\AbstractMigration;

class CreateFollowersTable extends AbstractMigration {




    public function up() {
        $this->execute(TableQueries::getFollowersTableCreationQuery());
    }




    public function down() {
        $this->execute(TableQueries::getFollowersTableDeletionQuery());
    }




}
