<?php

use yii\db\Migration;

class m160921_074836_reviews extends Migration
{
    public function up()
    {
      $tableOptions = null;
              if ($this->db->driverName === 'mysql') {
                  $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
              }
              $this->createTable('reviews', [
                  'id' => $this->primaryKey(),
                  'logo' => $this->string(255),
                  'category_id' => $this->integer(),
                  'adress' => $this->string(100),
              ], $tableOptions);
    }

    public function down()
    {
        echo "m160921_074836_reviews cannot be reverted.\n";

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
