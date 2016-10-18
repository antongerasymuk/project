<?php

use yii\db\Migration;

class m161004_091631_deposit_methods extends Migration
{
    public function up()
    {
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MyISAM';
        }
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
