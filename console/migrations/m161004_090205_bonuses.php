<?php

use yii\db\Migration;

class m161004_090205_bonuses extends Migration
{
    public function up()
    {
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MyISAM';
        }
        $this->createTable('{{%bonuses}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(50),
            'description' => $this->text(),
            'logo' => $this->string(100),
            'price' => $this->float(),
            'percent' => $this->float(),
            'code' => $this->string(20),
            'referal_url' => $this->string(255),
            'type' => $this->integer(1),
            'min_deposit' => $this->float(),
            'currency' => $this->string(1),
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
