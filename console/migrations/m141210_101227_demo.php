<?php

use yii\db\Schema;
use yii\db\Migration;

class m141210_101227_demo extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%demo}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'description' => Schema::TYPE_TEXT,
            'tags' => Schema::TYPE_TEXT,
            'create_time' => Schema::TYPE_TIMESTAMP . ' NULL DEFAULT 0',
            'update_time' => Schema::TYPE_TIMESTAMP . ' NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'active' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 1',
            'deleted' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%demo}}');
    }
}
