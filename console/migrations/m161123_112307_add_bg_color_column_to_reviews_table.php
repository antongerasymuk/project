<?php

use yii\db\Migration;

/**
 * Handles adding bg_color to table `reviews`.
 */
class m161123_112307_add_bg_color_column_to_reviews_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('reviews', 'bg_color', $this->string(7));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('reviews', 'bg_color');
    }
}
