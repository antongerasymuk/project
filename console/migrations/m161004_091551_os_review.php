<?php

use yii\db\Migration;

class m161004_091551_os_review extends Migration
{
    public function up()
    {
        $this->createTable('{{%os_review}}', [
            'os_id' => $this->integer(),
            'review_id' => $this->integer()
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%os_review}}');
    }
}
