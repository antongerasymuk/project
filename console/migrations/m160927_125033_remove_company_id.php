<?php

use yii\db\Migration;

class m160927_125033_remove_company_id extends Migration
{
    public function up()
    {
        $this->dropColumn('categories', 'company_id');
        $this->addColumn('reviews', 'category_id', $this->integer());
    }

    public function down()
    {
        echo "m160927_125033_remove_company_id cannot be reverted.\n";

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
