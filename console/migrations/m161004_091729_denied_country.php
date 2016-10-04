<?php

use yii\db\Migration;

class m161004_091729_denied_country extends Migration
{
    public function up()
    {
        $this->createTable('{{%denied_country}}', [
            'review_id' => $this->integer(),
            'country_id' => $this->integer()
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%denied_country}}');
    }
}
