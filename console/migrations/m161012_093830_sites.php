<?php

use yii\db\Migration;

class m161012_093830_sites extends Migration
{
    public function up()
    {
        $this->createTable('{{%sites}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'slug' => $this->string(),
            'content' => $this->text(),
            'category' => $this->string()
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%sites}}');
    }
}
