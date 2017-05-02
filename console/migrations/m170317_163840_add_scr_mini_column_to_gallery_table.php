<?php

use yii\db\Migration;

/**
 * Handles adding scr_mini to table `gallery`.
 */
class m170317_163840_add_scr_mini_column_to_gallery_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('gallery', 'scr_mini', $this->string(150));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('gallery', 'scr_mini');
    }
}
