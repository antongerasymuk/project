<?php

use yii\db\Migration;

class m161004_091521_gallery extends Migration
{
    public function up()
    {
        $this->createTable('{{%gallery}}', [
            'id' => $this->primaryKey(),
            'src' => $this->string(100)
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%gallery}}');
    }
}
