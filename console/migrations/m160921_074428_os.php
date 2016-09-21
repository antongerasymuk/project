<?php

use yii\db\Migration;

class m160921_074428_os extends Migration
{
    public function up()
    {
      $tableOptions = null;
              if ($this->db->driverName === 'mysql') {
                  $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
              }
              $this->createTable('os', [
                  'id' => $this->integer()->notNull(),
                  'title' => $this->string(10)->notNull(),

              ], $tableOptions);
    }

    public function down()
    {
        echo "m160921_074428_os cannot be reverted.\n";

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
