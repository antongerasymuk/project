<?php

use yii\db\Migration;

class m160930_091231_test_data extends Migration
{
    public function up()
    {
        $this->insert('companies', [

        ]);
    }

    public function down()
    {
        echo "m160930_091231_test_data cannot be reverted.\n";

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
