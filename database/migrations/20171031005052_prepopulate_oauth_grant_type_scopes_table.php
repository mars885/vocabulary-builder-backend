<?php

use App\Database\Queries\TableQueries;
use App\Database\Queries\UtilityQueries;
use App\Database\Schemas\Tables\OAuthGrantTypeScopesTable;
use App\Model\Constants\OAuthGrantTypes;
use App\Model\Constants\OAuthScopes;
use Phinx\Migration\AbstractMigration;

class PrepopulateOauthGrantTypeScopesTable extends AbstractMigration {




    public function up() {
        $table = $this->table(OAuthGrantTypeScopesTable::TABLE_NAME);

        $table->insert([
            [
                OAuthGrantTypeScopesTable::GRANT_TYPE_ID => OAuthGrantTypes::PASSWORD_ID,
                OAuthGrantTypeScopesTable::SCOPE_ID => OAuthScopes::R_EMAIL_ID
            ],
            [
                OAuthGrantTypeScopesTable::GRANT_TYPE_ID => OAuthGrantTypes::PASSWORD_ID,
                OAuthGrantTypeScopesTable::SCOPE_ID => OAuthScopes::W_EMAIL_ID
            ],
            [
                OAuthGrantTypeScopesTable::GRANT_TYPE_ID => OAuthGrantTypes::PASSWORD_ID,
                OAuthGrantTypeScopesTable::SCOPE_ID => OAuthScopes::R_PASSWORD_ID
            ],
            [
                OAuthGrantTypeScopesTable::GRANT_TYPE_ID => OAuthGrantTypes::PASSWORD_ID,
                OAuthGrantTypeScopesTable::SCOPE_ID => OAuthScopes::W_PASSWORD_ID
            ],
            [
                OAuthGrantTypeScopesTable::GRANT_TYPE_ID => OAuthGrantTypes::PASSWORD_ID,
                OAuthGrantTypeScopesTable::SCOPE_ID => OAuthScopes::R_USERS_ID
            ],
            [
                OAuthGrantTypeScopesTable::GRANT_TYPE_ID => OAuthGrantTypes::PASSWORD_ID,
                OAuthGrantTypeScopesTable::SCOPE_ID => OAuthScopes::W_USERS_ID
            ],
            [
                OAuthGrantTypeScopesTable::GRANT_TYPE_ID => OAuthGrantTypes::PASSWORD_ID,
                OAuthGrantTypeScopesTable::SCOPE_ID => OAuthScopes::R_WORDS_ID
            ],
            [
                OAuthGrantTypeScopesTable::GRANT_TYPE_ID => OAuthGrantTypes::PASSWORD_ID,
                OAuthGrantTypeScopesTable::SCOPE_ID => OAuthScopes::W_WORDS_ID
            ],
            [
                OAuthGrantTypeScopesTable::GRANT_TYPE_ID => OAuthGrantTypes::PASSWORD_ID,
                OAuthGrantTypeScopesTable::SCOPE_ID => OAuthScopes::R_QUIZZES_ID
            ],
            [
                OAuthGrantTypeScopesTable::GRANT_TYPE_ID => OAuthGrantTypes::PASSWORD_ID,
                OAuthGrantTypeScopesTable::SCOPE_ID => OAuthScopes::W_QUIZZES_ID
            ],
            [
                OAuthGrantTypeScopesTable::GRANT_TYPE_ID => OAuthGrantTypes::REFRESH_TOKEN_ID,
                OAuthGrantTypeScopesTable::SCOPE_ID => OAuthScopes::R_EMAIL_ID
            ],
            [
                OAuthGrantTypeScopesTable::GRANT_TYPE_ID => OAuthGrantTypes::REFRESH_TOKEN_ID,
                OAuthGrantTypeScopesTable::SCOPE_ID => OAuthScopes::W_EMAIL_ID
            ],
            [
                OAuthGrantTypeScopesTable::GRANT_TYPE_ID => OAuthGrantTypes::REFRESH_TOKEN_ID,
                OAuthGrantTypeScopesTable::SCOPE_ID => OAuthScopes::R_PASSWORD_ID
            ],
            [
                OAuthGrantTypeScopesTable::GRANT_TYPE_ID => OAuthGrantTypes::REFRESH_TOKEN_ID,
                OAuthGrantTypeScopesTable::SCOPE_ID => OAuthScopes::W_PASSWORD_ID
            ],
            [
                OAuthGrantTypeScopesTable::GRANT_TYPE_ID => OAuthGrantTypes::REFRESH_TOKEN_ID,
                OAuthGrantTypeScopesTable::SCOPE_ID => OAuthScopes::R_USERS_ID
            ],
            [
                OAuthGrantTypeScopesTable::GRANT_TYPE_ID => OAuthGrantTypes::REFRESH_TOKEN_ID,
                OAuthGrantTypeScopesTable::SCOPE_ID => OAuthScopes::W_USERS_ID
            ],
            [
                OAuthGrantTypeScopesTable::GRANT_TYPE_ID => OAuthGrantTypes::REFRESH_TOKEN_ID,
                OAuthGrantTypeScopesTable::SCOPE_ID => OAuthScopes::R_WORDS_ID
            ],
            [
                OAuthGrantTypeScopesTable::GRANT_TYPE_ID => OAuthGrantTypes::REFRESH_TOKEN_ID,
                OAuthGrantTypeScopesTable::SCOPE_ID => OAuthScopes::W_WORDS_ID
            ],
            [
                OAuthGrantTypeScopesTable::GRANT_TYPE_ID => OAuthGrantTypes::REFRESH_TOKEN_ID,
                OAuthGrantTypeScopesTable::SCOPE_ID => OAuthScopes::R_QUIZZES_ID
            ],
            [
                OAuthGrantTypeScopesTable::GRANT_TYPE_ID => OAuthGrantTypes::REFRESH_TOKEN_ID,
                OAuthGrantTypeScopesTable::SCOPE_ID => OAuthScopes::W_QUIZZES_ID
            ]
        ]);

        $table->saveData();
    }




    public function down() {
        $this->execute(UtilityQueries::getForeignKeyChecksDisablingQuery());
        $this->execute(TableQueries::getOAuthGrantTypeScopesTableTruncationQuery());
        $this->execute(UtilityQueries::getForeignKeyChecksEnablingQuery());
    }




}
