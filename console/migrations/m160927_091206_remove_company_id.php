<?php

use yii\db\Migration;

class m160927_091206_remove_company_id extends Migration
{
    public function up()
    {
//        $this->dropColumn('directors', 'company_id');
    }

    public function down()
    {
        echo "m160927_091206_remove_company_id cannot be reverted.\n";

        return false;
    }
}
