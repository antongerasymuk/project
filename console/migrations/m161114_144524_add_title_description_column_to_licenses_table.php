<?php

use yii\db\Migration;

/**
 * Handles adding title_description to table `licenses`.
 */
class m161114_144524_add_title_description_column_to_licenses_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('licenses', 'title_description', $this->string(60));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('licenses', 'title_description');
    }
}
