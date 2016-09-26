<?php

use yii\db\Migration;

class m160921_074311_denied_companies extends Migration
{
    public function up()
    {
      $tableOptions = null;
              if ($this->db->driverName === 'mysql') {
                  $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
              }
              $this->createTable('denied_countries', [
                  'review_id' => $this->integer()->notNull(),
                  'country_id' => $this->integer()->notNull(),
              ], $tableOptions);
    }

    public function down()
    {
        echo "m160921_074311_denied_companies cannot be reverted.\n";

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
