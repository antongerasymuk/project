<?php

use yii\db\Migration;

class m160921_074957_review_bonuse extends Migration
{
    public function up()
    {
      $tableOptions = null;
              if ($this->db->driverName === 'mysql') {
                  $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
              }
              $this->createTable('review_bonuse', [
                  'review_id' => $this->integer(),
                  'bonus_id' => $this->integer(),
              ], $tableOptions);
    }

    public function down()
    {
        echo "m160921_074957_review_bonuse cannot be reverted.\n";

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
