<?php

use App\Database\Queries\TriggerQueries;
use Phinx\Migration\AbstractMigration;

class CreateTriggersForUserDictionaryEntriesTable extends AbstractMigration {




    public function up() {
        $this->execute(TriggerQueries::getAfterInsertOnUserDictionaryEntriesTriggerCreationQuery());
        $this->execute(TriggerQueries::getAfterUpdateOnUserDictionaryEntriesTriggerCreationQuery());
        $this->execute(TriggerQueries::getAfterDeleteOnUserDictionaryEntriesTriggerCreationQuery());
    }




    public function down() {
        $this->execute(TriggerQueries::getAfterInsertOnUserDictionaryEntriesTriggerDeletionQuery());
        $this->execute(TriggerQueries::getAfterUpdateOnUserDictionaryEntriesTriggerDeletionQuery());
        $this->execute(TriggerQueries::getAfterDeleteOnUserDictionaryEntriesTriggerDeletionQuery());
    }




}
