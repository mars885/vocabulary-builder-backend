<?php

use App\Database\Queries\ProcedureQueries;
use Phinx\Migration\AbstractMigration;

class CreateProcedures extends AbstractMigration {




    public function up() {
        $this->execute(ProcedureQueries::getIncrementDictionaryEntryLearnerCountProcedureCreationQuery());
        $this->execute(ProcedureQueries::getDecrementDictionaryEntryLearnerCountProcedureCreationQuery());
        $this->execute(ProcedureQueries::getIncrementDictionaryEntryMasterCountProcedureCreationQuery());
        $this->execute(ProcedureQueries::getDecrementDictionaryEntryMasterCountProcedureCreationQuery());
        $this->execute(ProcedureQueries::getIncrementDictionaryEntryLikeCountProcedureCreationQuery());
        $this->execute(ProcedureQueries::getDecrementDictionaryEntryLikeCountProcedureCreationQuery());
        $this->execute(ProcedureQueries::getIncrementUserFriendCountCreationQuery());
        $this->execute(ProcedureQueries::getDecrementUserFriendCountCreationQuery());
        $this->execute(ProcedureQueries::getIncrementUserFollowerCountCreationQuery());
        $this->execute(ProcedureQueries::getDecrementUserFollowerCountCreationQuery());
    }




    public function down() {
        $this->execute(ProcedureQueries::getIncrementDictionaryEntryLearnerCountProcedureDeletionQuery());
        $this->execute(ProcedureQueries::getDecrementDictionaryEntryLearnerCountProcedureDeletionQuery());
        $this->execute(ProcedureQueries::getIncrementDictionaryEntryMasterCountProcedureDeletionQuery());
        $this->execute(ProcedureQueries::getDecrementDictionaryEntryMasterCountProcedureDeletionQuery());
        $this->execute(ProcedureQueries::getIncrementDictionaryEntryLikeCountProcedureDeletionQuery());
        $this->execute(ProcedureQueries::getDecrementDictionaryEntryLikeCountProcedureDeletionQuery());
        $this->execute(ProcedureQueries::getIncrementUserFriendCountDeletionQuery());
        $this->execute(ProcedureQueries::getDecrementUserFriendCountDeletionQuery());
        $this->execute(ProcedureQueries::getIncrementUserFollowerCountDeletionQuery());
        $this->execute(ProcedureQueries::getDecrementUserFollowerCountDeletionQuery());
    }




}
