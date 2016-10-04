<?php

use yii\db\Migration;

class m161004_091320_review_rating extends Migration
{
    public function up()
    {
        $this->createTable('{{%review_rating}}', [
            'review_id' => $this->integer(),
            'rating_id' => $this->integer()
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%review_rating}}');
    }
}
