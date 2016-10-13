<?php

use yii\db\Migration;

class m161013_120148_remove_os_image extends Migration
{
    public function up()
    {
        $this->dropColumn('{{%oses}}', 'src');
    }

    public function down()
    {
        $this->addColumn('{{%oses}}', 'src', $this->string());
    }
}
