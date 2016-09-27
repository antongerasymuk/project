<?php

use yii\db\Migration;

class m160927_105453_gallery extends Migration
{
    public function up()
    {
        $this->createTable('gallery', [
            'id' => $this->primaryKey(),
            'src' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);
    }

    public function down()
    {
        $this->dropTable('gallery');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
