<?php

use yii\db\Migration;

class m160927_081546_company_rating_field extends Migration
{
    public function up()
    {
        $this->addColumn('companies', 'rating', $this->integer(2));
    }

    public function down()
    {
        echo "m160927_081546_company_rating_field cannot be reverted.\n";

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
