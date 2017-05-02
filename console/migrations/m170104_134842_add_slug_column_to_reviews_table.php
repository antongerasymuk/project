<?php

use yii\db\Migration;

/**
 * Handles adding percent to table `bonuses`.
 */
class m170104_134842_add_slug_column_to_reviews_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('reviews', 'slug', $this->string(25));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('reviews', 'slug');
    }
}
