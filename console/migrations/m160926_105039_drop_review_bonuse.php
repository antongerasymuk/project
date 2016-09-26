<?php

use yii\db\Migration;

class m160926_105039_drop_review_bonuse extends Migration
{
    public function up()
    {
        $this->dropTable('review_bonuse');
    }

    public function down()
    {
        echo "m160926_105039_drop_review_bonuse cannot be reverted.\n";

        return false;
    }
}
