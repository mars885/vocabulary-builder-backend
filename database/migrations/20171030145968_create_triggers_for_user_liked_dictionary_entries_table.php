<?php

use App\Database\Queries\TriggerQueries;
use Phinx\Migration\AbstractMigration;

class CreateTriggersForUserLikedDictionaryEntriesTable extends AbstractMigration {




    public function up() {
        $this->execute(TriggerQueries::getAfterInsertOnUserLikedDictionaryEntriesTriggerCreationQuery());
        $this->execute(TriggerQueries::getAfterDeleteOnUserLikedDictionaryEntriesTriggerCreationQuery());
    }




    public function down() {
        $this->execute(TriggerQueries::getAfterInsertOnUserLikedDictionaryEntriesTriggerDeletionQuery());
        $this->execute(TriggerQueries::getAfterDeleteOnUserLikedDictionaryEntriesTriggerDeletionQuery());
    }




}
