<?php

use yii\db\Migration;

class m160927_124603_change_review_gallery extends Migration
{
    public function up()
    {
        $this->dropColumn('review_gallery', 'id');
        $this->renameColumn('review_gallery', 'image', 'gallery_id');
    }

    public function down()
    {
        echo "m160927_124603_change_review_gallery cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
