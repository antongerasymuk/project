<?php

use yii\db\Migration;

class m161004_090205_bonuses extends Migration
{
    public function up()
    {
        $this->createTable('{{%bonuses}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(50),
            'description' => $this->text(),
            'logo' => $this->string(100),
            'price' => $this->float(),
            'code' => $this->string(20),
            'referal_url' => $this->string(255),
            'type' => $this->integer(1),
            'min_deposit' => $this->float(),
            'expiry' => $this->integer(),
            'rollover_requirement' => $this->string(100),
            'restrictions' => $this->string(100),
            'review_id' => $this->integer()
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%bonuses}}');
    }
}
