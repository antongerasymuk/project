<?php

use yii\db\Migration;

class m170216_181905_add_columns_to_categories_table extends Migration
{
    public function up()
    {
        $this->addColumn('categories', 'no_deposit_main_text', $this->text());
        $this->addColumn('categories', 'no_deposit_notes', $this->text());
        $this->addColumn('categories', 'no_deposit_list_title', $this->string(50)->defaultValue(''));
        $this->addColumn('categories', 'code_main_text', $this->text());
        $this->addColumn('categories', 'code_notes', $this->text());
        $this->addColumn('categories', 'code_list_title', $this->string(50)->defaultValue(''));
    }

    public function down()
    {
        
        $this->dropColumn('categories', 'no_deposit_main_text');
        $this->dropColumn('categories', 'no_deposit_notes');
        $this->dropColumn('categories', 'no_deposit_list_title');
        $this->dropColumn('categories', 'code_main_text');
        $this->dropColumn('categories', 'code_notes');
        $this->dropColumn('categories', 'code_list_title');

    }
}
