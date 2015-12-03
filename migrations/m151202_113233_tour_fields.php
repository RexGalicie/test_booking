<?php

use yii\db\Migration;
use yii\db\Schema;

class m151202_113233_tour_fields extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%tour_fields}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . '(255) NOT NULL',
            'type' => Schema::TYPE_STRING . '(64) NOT NULL',
            'sort' => Schema::TYPE_INTEGER . '(2) NOT NULL',
            'tour_id' => Schema::TYPE_INTEGER . '(11) NULL DEFAULT NULL',

        ], $tableOptions);

        $this->createIndex('idx_tour_fields_tour_id', '{{%tour_fields}}', 'tour_id');

        $this->addForeignKey(
            'FK_tour', '{{%tour_fields}}', 'tour_id', '{{%tour}}', 'id', 'SET NULL', 'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%tour_fields}}');
    }
}
