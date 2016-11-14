<?php

use yii\db\Migration;

/**
 * Handles adding title_description to table `directors`.
 */
class m161114_144547_add_title_description_column_to_directors_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('directors', 'title_description', $this->string(60));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('directors', 'title_description');
    }
}
