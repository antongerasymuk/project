<?php

use yii\db\Migration;

/**
 * Handles adding check_dep to table `bonuses`.
 */
class m170119_100522_add_check_dep_column_to_bonuses_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('bonuses', 'check_no_dep', $this->integer(2)->defaultValue(0));
        $this->addColumn('bonuses', 'check_dep', $this->integer(2)->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('bonuses', 'check_no_dep');
        $this->addColumn('bonuses', 'check_dep');
    }
}
