<?php

use yii\db\Migration;

/**
 * Handles the creation of table `sites`.
 */
class m161005_065211_create_sites_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('sites', [
            'id' => $this->primaryKey(),
            'title' => $this->string(50),
            'stug' => $this->string(50),
            'content' => $this->string(250),
            'category_id' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('sites');
    }
}
