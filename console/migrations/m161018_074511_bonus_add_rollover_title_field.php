<?php

use yii\db\Migration;

class m161018_074511_bonus_add_rollover_title_field extends Migration
{
    public function up()
    {
        $this->addColumn('{{%bonuses}}', 'rollover_title', $this->string(25));
    }

    public function down()
    {
        $this->dropColumn('{{%bonuses}}', 'rollover_title');
    }
}
