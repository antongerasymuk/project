<?php

use yii\db\Migration;

class m161003_064305_contact extends Migration
{
    public function up()
    {

      $tableOptions = null;
              if ($this->db->driverName === 'mysql') {
                  $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
              }
              $this->createTable('contact', [
                  'id' => $this->primaryKey(),
                  'name' => $this->string(50),
                  'email' => $this->string(50),
                  'message' => $this->string(255),
              ], $tableOptions);
    
    }

    public function down()
    {
        echo "m161003_064305_contact cannot be reverted.\n";

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
