<?php

use yii\db\Migration;

class m161004_090946_company_license extends Migration
{
    public function up()
    {
        $this->createTable('{{%company_license}}', [
            'company_id' => $this->integer(),
            'license_id' => $this->integer()
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%company_license}}');
    }
}
