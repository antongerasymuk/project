<?php

use yii\db\Migration;

class m161013_124213_remove_company_description extends Migration
{
    public function up()
    {
        $this->dropColumn('{{%companies}}', 'description');
    }

    public function down()
    {
        $this->addColumn('{{%companies}}', 'description', $this->text());
    }
}
