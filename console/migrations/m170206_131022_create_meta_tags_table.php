<?php

use yii\db\Migration;

/**
 * Handles the creation of table `meta_tags`.
 */
class m170206_131022_create_meta_tags_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        
        $this->createTable('meta_tags', [
            'id' => $this->primaryKey(),
            'type' => $this->integer(9),
            'value' => $this->text(),
            'review_id' => $this->integer()->defaultValue(0),
            'category_id' => $this->integer()->defaultValue(0),
        ]);

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('meta_tags');
    }
}
