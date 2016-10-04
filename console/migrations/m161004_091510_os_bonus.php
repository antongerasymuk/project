<?php

use yii\db\Migration;

class m161004_091510_os_bonus extends Migration
{
    public function up()
    {
        $this->createTable('{{%os_bonus}}', [
            'os_id' => $this->integer(),
            'bonus_id' => $this->integer()
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%os_bonus}}');
    }
}
