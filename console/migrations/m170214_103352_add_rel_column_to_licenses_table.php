<?php

use yii\db\Migration;

/**
 * Handles adding rel to table `licenses`.
 */
class m170214_103352_add_rel_column_to_licenses_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('licenses', 'rel', $this->integer(2)->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('licenses', 'rel');
    }
}
