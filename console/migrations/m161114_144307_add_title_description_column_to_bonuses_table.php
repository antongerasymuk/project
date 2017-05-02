<?php

use yii\db\Migration;

/**
 * Handles adding title_description to table `bonuses`.
 */
class m161114_144307_add_title_description_column_to_bonuses_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('bonuses', 'title_description', $this->string(60));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('bonuses', 'title_description');
    }
}
