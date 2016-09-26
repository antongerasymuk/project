<?php

use yii\db\Migration;

class m160926_140847_review_minuse extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('review_minus', [
            'review_id' => $this->integer()->notNull(),
            'minus_id' => $this->integer()->notNull(),

        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('review_minus');
    }
}
