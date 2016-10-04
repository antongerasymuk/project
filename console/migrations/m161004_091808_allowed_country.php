<?php

use yii\db\Migration;

class m161004_091808_allowed_country extends Migration
{
    public function up()
    {
        $this->createTable('{{%allowed_country}}', [
            'review_id' => $this->integer(),
            'country_id' => $this->integer(),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%allowed_country}}');
    }
}
