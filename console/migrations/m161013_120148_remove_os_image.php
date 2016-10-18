<?php

use yii\db\Migration;

class m161013_120148_remove_os_image extends Migration
{
    public function up()
    {
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MyISAM';
        }
        $this->dropColumn('{{%oses}}', 'src');
    }

    public function down()
    {
        $this->addColumn('{{%oses}}', 'src', $this->string());
    }
}
