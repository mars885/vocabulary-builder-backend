<?php

use App\Database\Schemas\Tables\UserLikedDictionaryEntriesTable;
use Faker\Factory;
use Phinx\Seed\AbstractSeed;

class UserLikedDictionaryEntriesSeeder extends AbstractSeed {




    public function run() {
        $table = $this->table(UserLikedDictionaryEntriesTable::TABLE_NAME);

        $faker = Factory::create();
        $data = array();

        for($i = 0; $i < 100000; $i++) {
            $userId = (($i < 10000) ? 1 : $faker->numberBetween(2, 100000));
            $dictionaryEntryId = $faker->unique()->numberBetween(1, 207235);
            $createdAt = $faker->dateTimeThisYear('now')->format('Y-m-d H:i:s');
            $updatedAt = $createdAt;

            $data[] = [
                UserLikedDictionaryEntriesTable::USER_ID => $userId,
                UserLikedDictionaryEntriesTable::DICTIONARY_ENTRY_ID => $dictionaryEntryId,
                UserLikedDictionaryEntriesTable::CREATED_AT => $createdAt,
                UserLikedDictionaryEntriesTable::UPDATED_AT => $updatedAt
            ];
        }

        $table->insert($data);
        $table->saveData();
    }




}
