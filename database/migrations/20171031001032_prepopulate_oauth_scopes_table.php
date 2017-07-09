<?php

use App\Database\Queries\TableQueries;
use App\Database\Queries\UtilityQueries;
use App\Database\Schemas\Tables\OAuthScopesTable;
use App\Model\Constants\OAuthScopes;
use Phinx\Migration\AbstractMigration;

class PrepopulateOauthScopesTable extends AbstractMigration {




    public function up() {
        $table = $this->table(OAuthScopesTable::TABLE_NAME);

        $table->insert([
            [
                OAuthScopesTable::ID => OAuthScopes::R_EMAIL_ID,
                OAuthScopesTable::PERMISSION_ID => OAuthScopes::R_EMAIL_PERMISSION_ID,
                OAuthScopesTable::DOMAIN_ID => OAuthScopes::R_EMAIL_DOMAIN_ID,
                OAuthScopesTable::DESCRIPTION => OAuthScopes::R_EMAIL_DESCRIPTION
            ],
            [
                OAuthScopesTable::ID => OAuthScopes::W_EMAIL_ID,
                OAuthScopesTable::PERMISSION_ID => OAuthScopes::W_EMAIL_PERMISSION_ID,
                OAuthScopesTable::DOMAIN_ID => OAuthScopes::W_EMAIL_DOMAIN_ID,
                OAuthScopesTable::DESCRIPTION => OAuthScopes::W_EMAIL_DESCRIPTION
            ],
            [
                OAuthScopesTable::ID => OAuthScopes::R_PASSWORD_ID,
                OAuthScopesTable::PERMISSION_ID => OAuthScopes::R_PASSWORD_PERMISSION_ID,
                OAuthScopesTable::DOMAIN_ID => OAuthScopes::R_PASSWORD_DOMAIN_ID,
                OAuthScopesTable::DESCRIPTION => OAuthScopes::R_PASSWORD_DESCRIPTION
            ],
            [
                OAuthScopesTable::ID => OAuthScopes::W_PASSWORD_ID,
                OAuthScopesTable::PERMISSION_ID => OAuthScopes::W_PASSWORD_PERMISSION_ID,
                OAuthScopesTable::DOMAIN_ID => OAuthScopes::W_PASSWORD_DOMAIN_ID,
                OAuthScopesTable::DESCRIPTION => OAuthScopes::W_PASSWORD_DESCRIPTION
            ],
            [
                OAuthScopesTable::ID => OAuthScopes::R_USERS_ID,
                OAuthScopesTable::PERMISSION_ID => OAuthScopes::R_USERS_PERMISSION_ID,
                OAuthScopesTable::DOMAIN_ID => OAuthScopes::R_USERS_DOMAIN_ID,
                OAuthScopesTable::DESCRIPTION => OAuthScopes::R_USERS_DESCRIPTION
            ],
            [
                OAuthScopesTable::ID => OAuthScopes::W_USERS_ID,
                OAuthScopesTable::PERMISSION_ID => OAuthScopes::W_USERS_PERMISSION_ID,
                OAuthScopesTable::DOMAIN_ID => OAuthScopes::W_USERS_DOMAIN_ID,
                OAuthScopesTable::DESCRIPTION => OAuthScopes::W_USERS_DESCRIPTION
            ],
            [
                OAuthScopesTable::ID => OAuthScopes::R_WORDS_ID,
                OAuthScopesTable::PERMISSION_ID => OAuthScopes::R_WORDS_PERMISSION_ID,
                OAuthScopesTable::DOMAIN_ID => OAuthScopes::R_WORDS_DOMAIN_ID,
                OAuthScopesTable::DESCRIPTION => OAuthScopes::R_WORDS_DESCRIPTION
            ],
            [
                OAuthScopesTable::ID => OAuthScopes::W_WORDS_ID,
                OAuthScopesTable::PERMISSION_ID => OAuthScopes::W_WORDS_PERMISSION_ID,
                OAuthScopesTable::DOMAIN_ID => OAuthScopes::W_WORDS_DOMAIN_ID,
                OAuthScopesTable::DESCRIPTION => OAuthScopes::W_WORDS_DESCRIPTION
            ],
            [
                OAuthScopesTable::ID => OAuthScopes::R_QUIZZES_ID,
                OAuthScopesTable::PERMISSION_ID => OAuthScopes::R_QUIZZES_PERMISSION_ID,
                OAuthScopesTable::DOMAIN_ID => OAuthScopes::R_QUIZZES_DOMAIN_ID,
                OAuthScopesTable::DESCRIPTION => OAuthScopes::R_QUIZZES_DESCRIPTION
            ],
            [
                OAuthScopesTable::ID => OAuthScopes::W_QUIZZES_ID,
                OAuthScopesTable::PERMISSION_ID => OAuthScopes::W_QUIZZES_PERMISSION_ID,
                OAuthScopesTable::DOMAIN_ID => OAuthScopes::W_QUIZZES_DOMAIN_ID,
                OAuthScopesTable::DESCRIPTION => OAuthScopes::W_QUIZZES_DESCRIPTION
            ]
        ]);

        $table->saveData();
    }




    public function down() {
        $this->execute(UtilityQueries::getForeignKeyChecksDisablingQuery());
        $this->execute(TableQueries::getOAuthScopesTableTruncationQuery());
        $this->execute(UtilityQueries::getForeignKeyChecksEnablingQuery());
    }




}
