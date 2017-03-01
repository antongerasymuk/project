<?php

use yii\db\Migration;

/**
 * Handles adding hide_ext_url to table `companies`.
 */
class m170222_062632_add_hide_ext_url_column_to_companies_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('companies', 'hide_ext_url', $this->integer(3));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('companies', 'hide_ext_url');
    }
}
