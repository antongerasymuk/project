<?php

use yii\db\Migration;

class m161004_085046_companies extends Migration
{
    public function up()
    {
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MyISAM';
        }
        $this->createTable('{{%companies}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(50),
            'description' => $this->text(),
            'bg_color' => $this->string(7),
            'logo' => $this->string(50),
            'site_url' => $this->string(50),
            'address' => $this->text(),
            'rating' => $this->float(),
            'director_id' => $this->integer()
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%companies}}');
    }
}
