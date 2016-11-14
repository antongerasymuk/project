<?php

use yii\db\Migration;

/**
 * Handles adding title_description to table `pluses`.
 */
class m161114_144440_add_title_description_column_to_pluses_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('pluses', 'title_description', $this->string(60));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('pluses', 'title_description');
    }
}
