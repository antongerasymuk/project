<?php

use yii\db\Migration;

class m160921_074723_minuses extends Migration
{
    public function up()
    {
      $tableOptions = null;
              if ($this->db->driverName === 'mysql') {
                  $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
              }
              $this->createTable('minuses', [
                  'id' => $this->primaryKey(),
                  'title' => $this->string(255),

              ], $tableOptions);
    }

    public function down()
    {
        echo "m160921_074723_minuses cannot be reverted.\n";

        return false;
    }
}
