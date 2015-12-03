<?php

use yii\db\Migration;
use yii\db\Schema;

class m151202_161713_booking_fields extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%booking_fields}}', [
            'id' => Schema::TYPE_PK,
            'booking_id' => Schema::TYPE_INTEGER . '(11) NULL DEFAULT NULL',
            'fields' => Schema::TYPE_TEXT . ' NULL DEFAULT NULL',

        ], $tableOptions);

        $this->createIndex('idx_booking_fields_booking_id', '{{%booking_fields}}', 'booking_id');

        $this->addForeignKey(
            'FK_booking_fields_booking', '{{%booking_fields}}', 'booking_id', '{{%booking}}', 'id', 'SET NULL', 'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%booking_fields}}');
    }
}
