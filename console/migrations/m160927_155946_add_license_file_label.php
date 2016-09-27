<?php

use yii\db\Migration;

class m160927_155946_add_license_file_label extends Migration
{
    public function up()
    {
        $this->addColumn('licenses', 'file_label', $this->string());
    }

    public function down()
    {
        echo "m160927_155946_add_license_file_label cannot be reverted.\n";

        return false;
    }
}
