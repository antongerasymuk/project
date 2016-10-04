<?php

use yii\db\Migration;

class m161004_091617_directors extends Migration
{
    public function up()
    {
        $this->createTable('{{%directors}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(20),
            'description' => $this->text(),
            'photo' => $this->string(100)
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%directors}}');
    }
}
