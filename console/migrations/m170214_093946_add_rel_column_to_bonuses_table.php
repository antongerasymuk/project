<?php

use yii\db\Migration;

/**
 * Handles adding rel to table `bonuses`.
 */
class m170214_093946_add_rel_column_to_bonuses_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('bonuses', 'rel', $this->integer(2)->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('bonuses', 'rel');
    }
}
