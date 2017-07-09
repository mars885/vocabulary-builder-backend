<?php

use App\Authorization\Utils\OAuthClientGenerator;
use App\Database\Schemas\Tables\OAuthClientGrantTypesTable;
use App\Database\Schemas\Tables\OAuthClientScopesTable;
use App\Database\Schemas\Tables\OAuthClientsTable;
use App\Model\Constants\OAuthClientTypes;
use App\Model\Constants\OAuthGrantTypes;
use App\Model\Constants\OAuthScopes;
use Faker\Factory;
use Phinx\Seed\AbstractSeed;

class OauthClientsSeeder extends AbstractSeed {




    public function run() {
        $clientsTable = $this->table(OAuthClientsTable::TABLE_NAME);
        $clientGrantTypesTable = $this->table(OAuthClientGrantTypesTable::TABLE_NAME);
        $clientScopesTable = $this->table(OAuthClientScopesTable::TABLE_NAME);

        $faker = Factory::create();
        $clientTypes = [
            OAuthClientTypes::WEB_SERVER_BASED_ID,
            OAuthClientTypes::BROWSER_BASED_ID,
            OAuthClientTypes::MOBILE_ID,
            OAuthClientTypes::NATIVE_CLIENT_ID
        ];

        for($i = 0; $i < 10; $i++) {
            if($i === 0) {
                $clientId = '32ea5468eef722191387a3bbb154c179';
                $clientSecret = '366ba9c2ac1c65fdeceb1d2b2278f6035cb1793c08c6638948';
                $clientTypeId = OAuthClientTypes::MOBILE_ID;
                $clientOwnerId = 1;
                $isClientFirstParty = 1;
                $clientName = 'Client Name';
                $clientDescription = 'Client Description';
                $clientLogoFilePath = 'client/logo';
            } else {
                $clientId = OAuthClientGenerator::generateClientId();
                $clientSecret = OAuthClientGenerator::generateClientSecret();
                $clientTypeId = $faker->randomElement($clientTypes);
                $clientOwnerId = $faker->numberBetween(1, 100000);
                $isClientFirstParty = ($faker->boolean(30) ? 1 : 0);
                $clientName = ucfirst($faker->unique()->domainWord);
                $clientDescription = $faker->sentence(5);
                $clientLogoFilePath = ($faker->word . '/' . $faker->word);
            }

            $createdAt = $faker->dateTimeThisYear('now')->format('Y-m-d H:i:s');
            $updatedAt = $createdAt;

            $clientsTable->insert([
                OAuthClientsTable::ID => $clientId,
                OAuthClientsTable::SECRET => $clientSecret,
                OAuthClientsTable::CLIENT_TYPE_ID => $clientTypeId,
                OAuthClientsTable::OWNER_ID => $clientOwnerId,
                OAuthClientsTable::IS_FIRST_PARTY => $isClientFirstParty,
                OAuthClientsTable::NAME => $clientName,
                OAuthClientsTable::DESCRIPTION => $clientDescription,
                OAuthClientsTable::LOGO_FILE_PATH => $clientLogoFilePath,
                OAuthClientsTable::CREATED_AT => $createdAt,
                OAuthClientsTable::UPDATED_AT => $updatedAt
            ]);
            $clientGrantTypesTable->insert([
                [
                    OAuthClientGrantTypesTable::CLIENT_ID => $clientId,
                    OAuthClientGrantTypesTable::GRANT_TYPE_ID => ($isClientFirstParty ? OAuthGrantTypes::PASSWORD_ID : OAuthGrantTypes::AUTHORIZATION_CODE_ID),
                    OAuthClientGrantTypesTable::CREATED_AT => $createdAt,
                    OAuthClientGrantTypesTable::UPDATED_AT => $updatedAt
                ],
                [
                    OAuthClientGrantTypesTable::CLIENT_ID => $clientId,
                    OAuthClientGrantTypesTable::GRANT_TYPE_ID => OAuthGrantTypes::REFRESH_TOKEN_ID,
                    OAuthClientGrantTypesTable::CREATED_AT => $createdAt,
                    OAuthClientGrantTypesTable::UPDATED_AT => $updatedAt
                ]
            ]);
            $clientScopesTable->insert([
                [
                    OAuthClientScopesTable::CLIENT_ID => $clientId,
                    OAuthClientScopesTable::SCOPE_ID => OAuthScopes::W_USERS_ID,
                    OAuthClientScopesTable::CREATED_AT => $createdAt,
                    OAuthClientScopesTable::UPDATED_AT => $updatedAt
                ],
                [
                    OAuthClientScopesTable::CLIENT_ID => $clientId,
                    OAuthClientScopesTable::SCOPE_ID => OAuthScopes::W_WORDS_ID,
                    OAuthClientScopesTable::CREATED_AT => $createdAt,
                    OAuthClientScopesTable::UPDATED_AT => $updatedAt
                ],
                [
                    OAuthClientScopesTable::CLIENT_ID => $clientId,
                    OAuthClientScopesTable::SCOPE_ID => OAuthScopes::W_QUIZZES_ID,
                    OAuthClientScopesTable::CREATED_AT => $createdAt,
                    OAuthClientScopesTable::UPDATED_AT => $updatedAt
                ]
            ]);

            if($isClientFirstParty) {
                $clientScopesTable->insert([
                    [
                        OAuthClientScopesTable::CLIENT_ID => $clientId,
                        OAuthClientScopesTable::SCOPE_ID => OAuthScopes::W_EMAIL_ID,
                        OAuthClientScopesTable::CREATED_AT => $createdAt,
                        OAuthClientScopesTable::UPDATED_AT => $updatedAt
                    ],
                    [
                        OAuthClientScopesTable::CLIENT_ID => $clientId,
                        OAuthClientScopesTable::SCOPE_ID => OAuthScopes::W_PASSWORD_ID,
                        OAuthClientScopesTable::CREATED_AT => $createdAt,
                        OAuthClientScopesTable::UPDATED_AT => $updatedAt
                    ],
                ]);
            }
        }

        $clientsTable->saveData();
        $clientGrantTypesTable->saveData();
        $clientScopesTable->saveData();
    }




}
