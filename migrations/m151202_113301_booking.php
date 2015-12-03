<?php

use yii\db\Migration;
use yii\db\Schema;

class m151202_113301_booking extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%booking}}', [
            'id' => Schema::TYPE_PK,
            'time' => Schema::TYPE_DATETIME. ' NOT NULL',
            'address' => Schema::TYPE_STRING . '(250) NOT NULL',
            'group_num' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'agency_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'adults' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'childs' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'infants' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'tour_id' => Schema::TYPE_INTEGER . '(11) NULL DEFAULT NULL',
            'pick_up' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'drop_off' => Schema::TYPE_INTEGER . '(11) NOT NULL',

        ], $tableOptions);

        $this->createIndex('idx_booking_tour_id', '{{%booking}}', 'tour_id');

        $this->addForeignKey(
            'FK_booking', '{{%booking}}', 'tour_id', '{{%tour}}', 'id', 'SET NULL', 'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%booking}}');
    }
}
