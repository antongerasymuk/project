<?php

use yii\db\Migration;

class m161004_091134_ratings extends Migration
{
    public function up()
    {
        $this->createTable('{{%ratings}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string('50'),
            'mark' => $this->float()
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%ratings}}');
    }
}
