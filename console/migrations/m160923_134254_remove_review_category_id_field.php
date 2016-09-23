<?php

use yii\db\Migration;

class m160923_134254_remove_review_category_id_field extends Migration
{
    public function up()
    {
        $this->dropColumn('reviews', 'category_id');
    }

    public function down()
    {
        echo "m160923_134254_remove_review_category_id_field cannot be reverted.\n";

        return false;
    }
}
