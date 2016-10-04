<?php

use yii\db\Migration;

class m161004_090739_licenses extends Migration
{
    public function up()
    {
        $this->createTable('{{%licenses}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(50),
            'url' => $this->string(100),
            'file_label' => $this->string(50)
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%licenses}}');
    }
}
