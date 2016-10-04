<?php

use yii\db\Migration;

class m161004_091631_deposit_methods extends Migration
{
    public function up()
    {
        $this->createTable('{{%deposit_methods}}', [
            'id' => $this->primaryKey(),
            'logo' => $this->string(100),
            'title' => $this->string(15)
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%deposit_methods}}');
    }
}
