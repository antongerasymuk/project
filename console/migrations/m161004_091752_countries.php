<?php

use yii\db\Migration;

class m161004_091752_countries extends Migration
{
    public function up()
    {
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MyISAM';
        }
        $this->createTable('{{%countries}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(150)
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%countries}}');
    }
}
