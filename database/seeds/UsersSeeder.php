<?php

use App\Database\Schemas\Tables\UsersTable;
use App\Utils\PasswordUtils;
use App\Utils\Utils;
use Faker\Factory;
use Phinx\Seed\AbstractSeed;

class UsersSeeder extends AbstractSeed {




    public function run() {
        $table = $this->table(UsersTable::TABLE_NAME);

        $faker = Factory::create();
        $password = PasswordUtils::hashPassword('very_strong_password');
        $data = array();

        for($i = 0; $i < 100000; $i++) {
            if($i == 0) {
                $userName = 'randycarter';
                $fullName = 'Randy Carter';
                $email = 'randy.carter@gmail.com';
                $isActivated = 1;
                $activationToken = null;
            } else {
                $userName = $faker->unique()->userName;
                $fullName = ($faker->firstName . ' ' . $faker->lastName);
                $email = $faker->unique()->email;
                $isActivated = ($faker->boolean(75) ? 1 : 0);
                $activationToken = ($isActivated ? null : Utils::generateUniqueString(50));
            }

            $createdAt = $faker->dateTimeThisYear('now')->format('Y-m-d H:i:s');
            $updatedAt = $createdAt;

            $data[] = [
                UsersTable::USER_NAME => $userName,
                UsersTable::FULL_NAME => $fullName,
                UsersTable::EMAIL => $email,
                UsersTable::PASSWORD => $password,
                UsersTable::IS_ACTIVATED => $isActivated,
                UsersTable::ACTIVATION_TOKEN => $activationToken,
                UsersTable::CREATED_AT => $createdAt,
                UsersTable::UPDATED_AT => $updatedAt
            ];
        }

        $table->insert($data);
        $table->saveData();
    }




}
