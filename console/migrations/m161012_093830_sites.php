<?php

use yii\db\Migration;

class m161012_093830_sites extends Migration
{
    public function up()
    {
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MyISAM';
        }
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
