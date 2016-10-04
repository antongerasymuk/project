<?php

use yii\db\Migration;

class m161004_091850_review_minus extends Migration
{
    public function up()
    {
        $this->createTable('{{%review_minus}}', [
            'review_id' => $this->integer(),
            'minus_id' => $this->integer()
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%review_minus}}');
    }
}
