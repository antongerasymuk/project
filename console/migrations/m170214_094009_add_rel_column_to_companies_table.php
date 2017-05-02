<?php

use yii\db\Migration;

/**
 * Handles adding rel to table `companies`.
 */
class m170214_094009_add_rel_column_to_companies_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('companies', 'rel', $this->integer(2)->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('companies', 'rel');
    }
}
