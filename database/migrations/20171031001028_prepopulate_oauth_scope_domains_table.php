<?php

use App\Database\Queries\TableQueries;
use App\Database\Queries\UtilityQueries;
use App\Database\Schemas\Tables\OAuthScopeDomainsTable;
use App\Model\Constants\OAuthScopeDomains;
use Phinx\Migration\AbstractMigration;

class PrepopulateOauthScopeDomainsTable extends AbstractMigration {




    public function up() {
        $table = $this->table(OAuthScopeDomainsTable::TABLE_NAME);

        $table->insert([
            [
                OAuthScopeDomainsTable::ID => OAuthScopeDomains::EMAIL_ID,
                OAuthScopeDomainsTable::DOMAIN => OAuthScopeDomains::EMAIL
            ],
            [
                OAuthScopeDomainsTable::ID => OAuthScopeDomains::PASSWORD_ID,
                OAuthScopeDomainsTable::DOMAIN => OAuthScopeDomains::PASSWORD
            ],
            [
                OAuthScopeDomainsTable::ID => OAuthScopeDomains::USERS_ID,
                OAuthScopeDomainsTable::DOMAIN => OAuthScopeDomains::USERS
            ],
            [
                OAuthScopeDomainsTable::ID => OAuthScopeDomains::WORDS_ID,
                OAuthScopeDomainsTable::DOMAIN => OAuthScopeDomains::WORDS
            ],
            [
                OAuthScopeDomainsTable::ID => OAuthScopeDomains::QUIZZES_ID,
                OAuthScopeDomainsTable::DOMAIN => OAuthScopeDomains::QUIZZES
            ]
        ]);

        $table->saveData();
    }




    public function down() {
        $this->execute(UtilityQueries::getForeignKeyChecksDisablingQuery());
        $this->execute(TableQueries::getOAuthScopeDomainsTableTruncationQuery());
        $this->execute(UtilityQueries::getForeignKeyChecksEnablingQuery());
    }




}
