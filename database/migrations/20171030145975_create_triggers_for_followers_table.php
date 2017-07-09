<?php

use App\Database\Queries\TriggerQueries;
use Phinx\Migration\AbstractMigration;

class CreateTriggersForFollowersTable extends AbstractMigration {




    public function up() {
        $this->execute(TriggerQueries::getAfterInsertOnFollowersTriggerCreationQuery());
        $this->execute(TriggerQueries::getAfterDeleteOnFollowersTriggerCreationQuery());

    }




    public function down() {
        $this->execute(TriggerQueries::getAfterInsertOnFollowersTriggerDeletionQuery());
        $this->execute(TriggerQueries::getAfterDeleteOnFollowersTriggerDeletionQuery());
    }




}
