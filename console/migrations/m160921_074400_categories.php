<?php

use yii\db\Migration;

class m160921_074400_categories extends Migration
{
    public function up()
    {
      $tableOptions = null;
              if ($this->db->driverName === 'mysql') {
                  $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
              }
              $this->createTable('categories', [
                  'id' => $this->primaryKey(),
                  'title' => $this->string(30)->notNull(),
                  'company_id' => $this->integer()->notNull(),

              ], $tableOptions);
    }

    public function down()
    {
        echo "m160921_074400_categories cannot be reverted.\n";

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
