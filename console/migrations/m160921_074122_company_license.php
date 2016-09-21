<?php

use yii\db\Migration;

class m160921_074122_company_license extends Migration
{
    public function up()
    {
      $tableOptions = null;
              if ($this->db->driverName === 'mysql') {
                  $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
              }
              $this->createTable('company_license', [
                  'company_id' => $this->primaryKey(),
                  'license_id' => $this->integer(),                  
              ], $tableOptions);
    }

    public function down()
    {
        echo "m160921_074122_company_license cannot be reverted.\n";

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
