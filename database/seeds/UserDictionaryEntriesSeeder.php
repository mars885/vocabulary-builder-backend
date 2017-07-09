<?php

use App\Database\Schemas\Tables\UserDictionaryEntriesTable;
use App\Model\Constants\WordCategories;
use Faker\Factory;
use Phinx\Seed\AbstractSeed;

class UserDictionaryEntriesSeeder extends AbstractSeed {




    public function run() {
        $table = $this->table(UserDictionaryEntriesTable::TABLE_NAME);

        $faker = Factory::create();
        $wordCategories = array(
            WordCategories::LEARNING_ID,
            WordCategories::MASTERED_ID
        );
        $data = array();

        for($i = 0; $i < 100000; $i++) {
            $userId = (($i < 10000) ? 1 : $faker->numberBetween(2, 100000));
            $dictionaryEntryId = $faker->unique()->numberBetween(1, 207235);
            $wordCategoryId = $faker->randomElement($wordCategories);
            $createdAt = $faker->dateTimeThisYear('now')->format('Y-m-d H:i:s');
            $updatedAt = $createdAt;

            $data[] = [
                UserDictionaryEntriesTable::USER_ID => $userId,
                UserDictionaryEntriesTable::DICTIONARY_ENTRY_ID => $dictionaryEntryId,
                UserDictionaryEntriesTable::WORD_CATEGORY_ID => $wordCategoryId,
                UserDictionaryEntriesTable::CREATED_AT => $createdAt,
                UserDictionaryEntriesTable::UPDATED_AT => $updatedAt
            ];
        }

        $table->insert($data);
        $table->saveData();
    }




}
