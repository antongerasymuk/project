<?php

use yii\db\Migration;

class m160923_073442_change_review_logo_column extends Migration
{
    public function up()
    {
        $this->renameColumn('reviews', 'logo', 'preview');
    }

    public function down()
    {
        echo "m160923_073442_change_review_logo_column cannot be reverted.\n";

        return false;
    }
}
