<?php

use App\Database\Queries\TableQueries;
use App\Database\Queries\UtilityQueries;
use App\Database\Schemas\Tables\OAuthOwnerTypesTable;
use App\Model\Constants\OAuthOwnerTypes;
use Phinx\Migration\AbstractMigration;

class PrepopulateOauthOwnerTypesTable extends AbstractMigration {




    public function up() {
        $table = $this->table(OAuthOwnerTypesTable::TABLE_NAME);

        $table->insert([
            [
                OAuthOwnerTypesTable::ID => OAuthOwnerTypes::CLIENT_ID,
                OAuthOwnerTypesTable::TYPE => OAuthOwnerTypes::CLIENT
            ],
            [
                OAuthOwnerTypesTable::ID => OAuthOwnerTypes::USER_ID,
                OAuthOwnerTypesTable::TYPE => OAuthOwnerTypes::USER
            ]
        ]);

        $table->saveData();
    }




    public function down() {
        $this->execute(UtilityQueries::getForeignKeyChecksDisablingQuery());
        $this->execute(TableQueries::getOAuthOwnerTypesTableTruncationQuery());
        $this->execute(UtilityQueries::getForeignKeyChecksEnablingQuery());
    }




}
