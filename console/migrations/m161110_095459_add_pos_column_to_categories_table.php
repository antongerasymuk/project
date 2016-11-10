<?php

use yii\db\Migration;

/**
 * Handles adding pos to table `categories`.
 */
class m161110_095459_add_pos_column_to_categories_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('categories', 'pos', $this->integer(2));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('categories', 'pos');
    }
}
