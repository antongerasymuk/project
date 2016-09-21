<?php

use yii\db\Migration;

class m160921_075045_alternative_sites extends Migration
{
    public function up()
    {
      $tableOptions = null;
              if ($this->db->driverName === 'mysql') {
                  $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
              }
              $this->createTable('alternative_sites', [
                  'id' => $this->primaryKey(),
                  'title' => $this->string(15),
                  'url' => $this->string(255),
                  'review_id' => $this->string(255),
              ], $tableOptions);
    }

    public function down()
    {
        echo "m160921_075045_alternative_sites cannot be reverted.\n";

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
