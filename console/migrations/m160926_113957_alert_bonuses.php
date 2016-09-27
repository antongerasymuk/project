<?php

use yii\db\Migration;

class m160926_113957_alert_bonuses extends Migration
{
    public function up()
    {
        $this->addColumn('bonuses', 'min_deposit', $this->float());
        $this->addColumn('bonuses', 'expiry', $this->integer());
        $this->addColumn('bonuses', 'rollover_requirement', $this->string(10));
        $this->addColumn('bonuses', 'restrictions', $this->string());
    }

    public function down()
    {
        echo "m160926_113957_alert_bonuses cannot be reverted.\n";

        return false;
    }
}
