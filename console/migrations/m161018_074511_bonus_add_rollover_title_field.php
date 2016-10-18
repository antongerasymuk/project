<?php

use yii\db\Migration;

class m161018_074511_bonus_add_rollover_title_field extends Migration
{
    public function up()
    {
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MyISAM';
        }
        $this->addColumn('{{%bonuses}}', 'rollover_title', $this->string(25));
    }

    public function down()
    {
        $this->dropColumn('{{%bonuses}}', 'rollover_title');
    }
}
