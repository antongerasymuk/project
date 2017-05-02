<?php

use yii\db\Migration;

/**
 * Handles adding hide_ext_url to table `bonuses`.
 */
class m170222_062429_add_hide_ext_url_column_to_bonuses_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('bonuses', 'hide_ext_url', $this->integer(3));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('bonuses', 'hide_ext_url');
    }
}
