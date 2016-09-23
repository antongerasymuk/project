<?php

use yii\db\Migration;

class m160923_134423_company_review extends Migration
{
    public function up()
    {
        $this->createTable('company_review', [
            'company_id' => $this->integer(),
            'review_id' => $this->integer()
        ]);
    }

    public function down()
    {
        echo "m160923_134423_company_review cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
