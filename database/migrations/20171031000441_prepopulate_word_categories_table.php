<?php

use App\Database\Queries\TableQueries;
use App\Database\Queries\UtilityQueries;
use App\Database\Schemas\Tables\WordCategoriesTable;
use App\Model\Constants\WordCategories;
use Phinx\Migration\AbstractMigration;

class PrepopulateWordCategoriesTable extends AbstractMigration {




    public function up() {
        $table = $this->table(WordCategoriesTable::TABLE_NAME);

        $table->insert([
            [
                WordCategoriesTable::ID => WordCategories::NEW_ID,
                WordCategoriesTable::CATEGORY => WordCategories::NEW
            ],
            [
                WordCategoriesTable::ID => WordCategories::LEARNING_ID,
                WordCategoriesTable::CATEGORY => WordCategories::LEARNING
            ],
            [
                WordCategoriesTable::ID => WordCategories::MASTERED_ID,
                WordCategoriesTable::CATEGORY => WordCategories::MASTERED
            ]
        ]);

        $table->saveData();
    }




    public function down() {
        $this->execute(UtilityQueries::getForeignKeyChecksDisablingQuery());
        $this->execute(TableQueries::getWordCategoriesTableTruncationQuery());
        $this->execute(UtilityQueries::getForeignKeyChecksEnablingQuery());
    }




}
