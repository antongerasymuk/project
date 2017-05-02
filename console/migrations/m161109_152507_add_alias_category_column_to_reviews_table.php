<?php

use yii\db\Migration;

/**
 * Handles adding alias_category to table `reviews`.
 */
class m161109_152507_add_alias_category_column_to_reviews_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('reviews', 'position', $this->string(40));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('reviews', 'position');
    }
}
