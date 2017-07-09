<?php

use App\Database\Queries\TableQueries;
use App\Database\Queries\UtilityQueries;
use App\Database\Schemas\Tables\OAuthGrantTypesTable;
use App\Model\Constants\OAuthGrantTypes;
use Phinx\Migration\AbstractMigration;

class PrepopulateOauthGrantTypesTable extends AbstractMigration {




    public function up() {
        $table = $this->table(OAuthGrantTypesTable::TABLE_NAME);

        $table->insert([
            [
                OAuthGrantTypesTable::ID => OAuthGrantTypes::AUTHORIZATION_CODE_ID,
                OAuthGrantTypesTable::TYPE => OAuthGrantTypes::AUTHORIZATION_CODE
            ],
            [
                OAuthGrantTypesTable::ID => OAuthGrantTypes::IMPLICIT_ID,
                OAuthGrantTypesTable::TYPE => OAuthGrantTypes::IMPLICIT
            ],
            [
                OAuthGrantTypesTable::ID => OAuthGrantTypes::PASSWORD_ID,
                OAuthGrantTypesTable::TYPE => OAuthGrantTypes::PASSWORD
            ],
            [
                OAuthGrantTypesTable::ID => OAuthGrantTypes::CLIENT_CREDENTIALS_ID,
                OAuthGrantTypesTable::TYPE => OAuthGrantTypes::CLIENT_CREDENTIALS
            ],
            [
                OAuthGrantTypesTable::ID => OAuthGrantTypes::REFRESH_TOKEN_ID,
                OAuthGrantTypesTable::TYPE => OAuthGrantTypes::REFRESH_TOKEN
            ]
        ]);

        $table->saveData();
    }




    public function down() {
        $this->execute(UtilityQueries::getForeignKeyChecksDisablingQuery());
        $this->execute(TableQueries::getOAuthGrantTypesTableTruncationQuery());
        $this->execute(UtilityQueries::getForeignKeyChecksEnablingQuery());
    }




}
