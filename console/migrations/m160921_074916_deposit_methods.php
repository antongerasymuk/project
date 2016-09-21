<?php

use yii\db\Migration;

class m160921_074916_deposit_methods extends Migration
{
    public function up()
    {
      $tableOptions = null;
              if ($this->db->driverName === 'mysql') {
                  $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
              }
              $this->createTable('deposit_methods', [
                  'id' => $this->primaryKey(),
                  'logo' => $this->string(255),
                  'title' => $this->string(15),
              ], $tableOptions);
    }

    public function down()
    {
        echo "m160921_074916_deposit_methods cannot be reverted.\n";

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
