<?php

use yii\db\Migration;

class m160926_140847_review_minuse extends Migration
{
    public function up()
    {
    }

    public function down()
    {
        $this->dropTable('review_minus');
    }
}
