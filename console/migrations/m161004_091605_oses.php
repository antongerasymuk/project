<?php

use yii\db\Migration;

class m161004_091605_oses extends Migration
{
    public function up()
    {
        $this->createTable('{{%oses}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(10),
            'src' => $this->string(100),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%oses}}');
    }
}
