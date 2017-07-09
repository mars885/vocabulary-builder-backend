<?php

use App\Database\Queries\TableQueries;
use App\Database\Queries\UtilityQueries;
use App\Database\Schemas\Tables\OAuthClientTypesTable;
use App\Model\Constants\OAuthClientTypes;
use Phinx\Migration\AbstractMigration;

class PrepopulateOauthClientTypesTable extends AbstractMigration {




    public function up() {
        $table = $this->table(OAuthClientTypesTable::TABLE_NAME);

        $table->insert([
            [
                OAuthClientTypesTable::ID => OAuthClientTypes::WEB_SERVER_BASED_ID,
                OAuthClientTypesTable::TYPE => OAuthClientTypes::WEB_SERVER_BASED
            ],
            [
                OAuthClientTypesTable::ID => OAuthClientTypes::BROWSER_BASED_ID,
                OAuthClientTypesTable::TYPE => OAuthClientTypes::BROWSER_BASED
            ],
            [
                OAuthClientTypesTable::ID => OAuthClientTypes::NATIVE_CLIENT_ID,
                OAuthClientTypesTable::TYPE => OAuthClientTypes::NATIVE
            ],
            [
                OAuthClientTypesTable::ID => OAuthClientTypes::MOBILE_ID,
                OAuthClientTypesTable::TYPE => OAuthClientTypes::MOBILE
            ]
        ]);

        $table->saveData();
    }




    public function down() {
        $this->execute(UtilityQueries::getForeignKeyChecksDisablingQuery());
        $this->execute(TableQueries::getOAuthClientTypesTableTruncationQuery());
        $this->execute(UtilityQueries::getForeignKeyChecksEnablingQuery());
    }




}
