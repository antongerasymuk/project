<?php

use yii\db\Migration;

class m160927_134317_add_os_logo extends Migration
{
    public function up()
    {
        $this->addColumn('os', 'logo', $this->string());
    }

    public function down()
    {
        echo "m160927_134317_add_os_logo cannot be reverted.\n";

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
