<?php

use yii\db\Migration;

class m160927_090708_company_director_id extends Migration
{
    public function up()
    {
        $this->addColumn('companies', 'director_id', $this->integer());
    }

    public function down()
    {
        echo "m160927_090708_company_director_id cannot be reverted.\n";

        return false;
    }
}
