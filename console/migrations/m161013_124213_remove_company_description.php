<?php

use yii\db\Migration;

class m161013_124213_remove_company_description extends Migration
{
    public function up()
    {
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MyISAM';
        }
        $this->dropColumn('{{%companies}}', 'description');
    }

    public function down()
    {
        $this->addColumn('{{%companies}}', 'description', $this->text());
    }
}
