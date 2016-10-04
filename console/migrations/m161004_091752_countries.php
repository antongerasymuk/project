<?php

use yii\db\Migration;

class m161004_091752_countries extends Migration
{
    public function up()
    {
        $this->createTable('{{%countries}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(150)
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%countries}}');
    }
}
