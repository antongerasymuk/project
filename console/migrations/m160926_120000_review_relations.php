<?php

use yii\db\Migration;

class m160926_120000_review_relations extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('review_pros', [
            'review_id' => $this->integer()->notNull(),
            'pos_id' => $this->integer()->notNull(),

        ], $tableOptions);
    }

    public function down()
    {
        echo "m160926_120000_review_relations cannot be reverted.\n";

        return false;
    }
}
