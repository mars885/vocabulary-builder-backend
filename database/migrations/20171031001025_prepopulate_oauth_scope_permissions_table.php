<?php

use App\Database\Queries\TableQueries;
use App\Database\Queries\UtilityQueries;
use App\Database\Schemas\Tables\OAuthScopePermissionsTable;
use App\Model\Constants\OAuthScopePermissions;
use Phinx\Migration\AbstractMigration;

class PrepopulateOauthScopePermissionsTable extends AbstractMigration {




    public function up() {
        $table = $this->table(OAuthScopePermissionsTable::TABLE_NAME);

        $table->insert([
            [
                OAuthScopePermissionsTable::ID => OAuthScopePermissions::READ_ID,
                OAuthScopePermissionsTable::PERMISSION => OAuthScopePermissions::READ
            ],
            [
                OAuthScopePermissionsTable::ID => OAuthScopePermissions::WRITE_ID,
                OAuthScopePermissionsTable::PERMISSION => OAuthScopePermissions::WRITE
            ]
        ]);

        $table->saveData();
    }




    public function down() {
        $this->execute(UtilityQueries::getForeignKeyChecksDisablingQuery());
        $this->execute(TableQueries::getOAuthScopePermissionsTableTruncationQuery());
        $this->execute(UtilityQueries::getForeignKeyChecksEnablingQuery());
    }




}
