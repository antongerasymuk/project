<?php

use yii\db\Migration;

class m161004_091534_review_gallery extends Migration
{
    public function up()
    {
        $this->createTable('{{%review_gallery}}', [
            'review_id' => $this->integer(),
            'gallery_id' => $this->integer()
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%review_gallery}}');
    }
}
