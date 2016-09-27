<?php

use yii\db\Migration;

class m160921_075014_review_gallery extends Migration
{
    public function up()
    {
      $tableOptions = null;
              if ($this->db->driverName === 'mysql') {
                  $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
              }
              $this->createTable('review_gallery', [
                  'id' => $this->integer(),
                  'review_id' =>  $this->integer()->notNull(),
                  'image' => $this->integer(),
              ], $tableOptions);
    }

    public function down()
    {
        echo "m160921_075014_review_gallery cannot be reverted.\n";

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
