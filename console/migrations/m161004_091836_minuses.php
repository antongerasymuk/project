<?php

use yii\db\Migration;

class m161004_091836_minuses extends Migration
{
    public function up()
    {
        $this->createTable('{{%minuses}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(100)
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%minuses}}');
    }
}
