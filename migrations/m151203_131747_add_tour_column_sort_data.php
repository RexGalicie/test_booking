<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

class m151203_131747_add_tour_column_sort_data extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%tour}}', 'sort', Schema::TYPE_TEXT);

    }

    public function safeDown()
    {
        $this->dropColumn('{{%tour}}', 'sort');
    }
}
