<?php

use yii\db\Migration;

class m160921_074644_directors extends Migration
{
    public function up()
    {
      $tableOptions = null;
      if ($this->db->driverName === 'mysql') {
          $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
      }
      $this->createTable('directors', [
          'id' => $this->primaryKey(),
          'description' => $this->string(255),
          'photo' => $this->string(255),
          'company_id' => $this->integer()->notNull(),
      ], $tableOptions);
    }

    public function down()
    {
        echo "m160921_074644_directors cannot be reverted.\n";

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
