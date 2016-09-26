<?php

use yii\db\Migration;

class m160926_115326_remove_pros_minus_relation_table extends Migration
{
    public function up()
    {
        $this->dropTable('review_pos');
        $this->dropTable('review_minus');

        // relation one to many Review -> Pros, Minuses
        $this->addColumn('pros', 'review_id', $this->integer());
        $this->addColumn('minuses', 'review_id', $this->integer());
    }

    public function down()
    {
        echo "m160926_115326_remove_pros_minus_relation_table cannot be reverted.\n";

        return false;
    }
}
