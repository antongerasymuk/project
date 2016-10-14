<?php

use yii\db\Migration;

class m161013_142333_remove_company_address extends Migration
{
    public function up()
    {
        $this->dropColumn('{{%companies}}', 'address');
    }

    public function down()
    {
        $this->addColumn('{{%companies}}', 'address', $this->text());
    }
}
