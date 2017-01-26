<?php

use yii\db\Migration;

/**
 * Handles adding logo_small to table `companies`.
 */
class m170123_191114_add_logo_small_column_to_companies_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('companies', 'logo_small', $this->string(100)->defaultValue(''));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('companies', 'logo_small');
    }
}
