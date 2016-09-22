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
                  'title' => $this->string(50),
                  'description' => $this->text(),
                  'logo' => $this->string(255),
                  'category_id' => $this->integer()->notNull(),
                  'address' => $this->string(100),
              ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('reviews');
    }
}
