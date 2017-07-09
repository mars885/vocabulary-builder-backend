<?php

use App\Database\Schemas\Tables\FollowersTable;
use Faker\Factory;
use Phinx\Seed\AbstractSeed;

class FollowersSeeder extends AbstractSeed {




    public function run() {
        $table = $this->table(FollowersTable::TABLE_NAME);

        $faker = Factory::create();
        $data = array();

        for($i = 0; $i < 100000; $i++) {
            if($i < 10000) {
                $followerId = 1;
                $friendId = $faker->unique()->numberBetween(2, 100000);
            } else if($i >= 10000 && $i < 20000) {
                $followerId = $faker->unique()->numberBetween(2, 100000);
                $friendId = 1;
            } else {
                $followerId = $faker->numberBetween(2, 100000);
                $friendId = $faker->numberBetween(2, 100000);
            }

            $createdAt = $faker->dateTimeThisYear('now')->format('Y-m-d H:i:s');

            $data[] = [
                FollowersTable::FOLLOWER_ID => $followerId,
                FollowersTable::FRIEND_ID => $friendId,
                FollowersTable::CREATED_AT => $createdAt,
                FollowersTable::UPDATED_AT => $createdAt
            ];
        }

        $table->insert($data);
        $table->saveData();
    }




}
