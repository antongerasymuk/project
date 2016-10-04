<?php

use yii\db\Migration;

class m161004_091830_pluses extends Migration
{
    public function up()
    {
        $this->createTable('{{%pluses}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(100)
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%pluses}}');
    }
}
