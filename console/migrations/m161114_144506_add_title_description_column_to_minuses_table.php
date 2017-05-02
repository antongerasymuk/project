<?php

use yii\db\Migration;

/**
 * Handles adding title_description to table `minuses`.
 */
class m161114_144506_add_title_description_column_to_minuses_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('minuses', 'title_description', $this->string(60));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('minuses', 'title_description');
    }
}
