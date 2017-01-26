<?php

use yii\db\Migration;

class m170108_134946_site_numbers extends Migration
{
    public function up()
    {
        $this->createTable('site_numbers', [
            'id' => $this->primaryKey()->notNull(),
            'type' => $this->integer()->notNull(),
            'value' => $this->integer(),
        ]);
    }

    public function down()
    {
        $this->dropTable('site_numbers');
    }
}
