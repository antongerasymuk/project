<?php

use yii\db\Migration;

class m161004_085609_reviews extends Migration
{
    public function up()
    {
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MyISAM';
        }
        $this->createTable('{{%reviews}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(50),
            'description' => $this->text(),
            'logo' => $this->string(100),
            'preview' => $this->string(100),
            'preview_title' => $this->string(100),
            'address' => $this->text(),
            'type' => $this->integer(1),
            'category_id' => $this->integer(),
            'company_id' => $this->integer()
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%reviews}}');
    }
}
