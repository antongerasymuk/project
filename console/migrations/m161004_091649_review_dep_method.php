<?php

use yii\db\Migration;

class m161004_091649_review_dep_method extends Migration
{
    public function up()
    {
        $this->createTable('{{%review_dep_method}}', [
            'review_id' => $this->integer(),
            'dep_method' => $this->integer()
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%review_dep_method}}');
    }
}
