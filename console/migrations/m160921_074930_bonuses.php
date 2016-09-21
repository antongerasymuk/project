<?php

use yii\db\Migration;

class m160921_074930_bonuses extends Migration
{
    public function up()
    {
      $tableOptions = null;
      if ($this->db->driverName === 'mysql') {
          $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
      }
      $this->createTable('bonuses', [
          'id' => $this->primaryKey(),
          'title' => $this->string(50)->notNull(),
          'description' => $this->text(),
          'logo' => $this->string(),
          'price' => $this->float(),
          'code' => $this->string(15),
          'referal_url' => $this->string(255),
          'type' => $this->integer(1),
      ], $tableOptions);
    }

    public function down()
    {
        echo "m160921_074930_bonuses cannot be reverted.\n";

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
