<?php

use yii\db\Migration;

/**
 * Handles adding title_description to table `reviews`.
 */
class m161114_144606_add_title_description_column_to_reviews_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('reviews', 'title_description', $this->string(60));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('reviews', 'title_description');
    }
}
