<?php

use yii\db\Migration;

/**
 * Handles adding main_text to table `countries`.
 */
class m170123_095822_add_main_text_column_to_categories_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('categories', 'main_text', $this->text());
        $this->addColumn('categories', 'notes', $this->text());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('categories', 'main_text');
        $this->dropColumn('categories', 'notes');
    }
}
