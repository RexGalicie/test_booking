<?php

use yii\db\Migration;
use yii\db\Schema;

class m151202_112640_tour extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%tour}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . '(150) NOT NULL',
        ], $tableOptions);

    }

    public function safeDown()
    {
        $this->dropTable('{{%tour}}');
    }
}
