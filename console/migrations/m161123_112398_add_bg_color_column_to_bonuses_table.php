<?php

use yii\db\Migration;

/**
 * Handles adding bg_color to table `reviews`.
 */
class m161123_112398_add_bg_color_column_to_bonuses_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('bonuses', 'bg_color', $this->string(7)->notNull());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('bonuses', 'bg_color');
    }
}
