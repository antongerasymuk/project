<?php

use yii\db\Migration;

class m161004_090015_categories extends Migration
{
    public function up()
    {
        $this->createTable('{{%categories}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(50)
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%categories}}');
    }
}
