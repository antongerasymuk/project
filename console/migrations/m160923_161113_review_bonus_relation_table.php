<?php

use yii\db\Migration;

class m160923_161113_review_bonus_relation_table extends Migration
{
    public function up()
    {
        $this->createTable('review_bonus', [
            'review_id' => $this->integer(),
            'bonus_id' => $this->integer()
        ]);
    }

    public function down()
    {
        $this->dropTable('review_bonus');
    }
}
