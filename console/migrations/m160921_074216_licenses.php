<?php

use yii\db\Migration;

class m160921_074216_licenses extends Migration
{
    public function up()
    {
      $tableOptions = null;
              if ($this->db->driverName === 'mysql') {
                  $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
              }
              $this->createTable('licenses', [
                  'id' => $this->primaryKey(),
                  'title' => $this->string(25)->notNull(),
                  'url' => $this->string(255)->notNull(),
              ], $tableOptions);
    }

    public function down()
    {
        echo "m160921_074216_licenses cannot be reverted.\n";

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
