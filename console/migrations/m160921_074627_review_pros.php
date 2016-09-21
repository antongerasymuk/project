<?php

use yii\db\Migration;

class m160921_074627_review_pros extends Migration
{
    public function up()
    {
      $tableOptions = null;
              if ($this->db->driverName === 'mysql') {
                  $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
              }
              $this->createTable('review_pos', [
                  'review_id' => $this->integer()->notNull(),
                  'pos_id' => $this->integer()->notNull(),

              ], $tableOptions);
    }

    public function down()
    {
        echo "m160921_074627_review_pros cannot be reverted.\n";

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
