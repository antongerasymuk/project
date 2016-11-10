<?php

use yii\db\Migration;

/**
 * Handles dropping pos from table `companies`.
 */
class m161110_095045_drop_pos_column_from_companies_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropColumn('companies', 'pos');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->addColumn('companies', 'pos', $this->integer(2));
    }
}
