<?php

use yii\db\Migration;

class m161004_091702_review_plus extends Migration
{
    public function up()
    {
        $this->createTable('{{%review_plus}}', [
            'review_id' => $this->integer(),
            'plus_id' => $this->integer()
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%review_plus}}');
    }
}
