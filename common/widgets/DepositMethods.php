<?php
namespace common\widgets;

use common\models\DepositMethod;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class DepositMethods extends Widget
{
    public $methods;

    public function init()
    {
        parent::init();

        $this->methods = DepositMethod::find()->asArray()->all();
    }

    public function run()
    {
        $options = '';
        $options .= Html::tag('option', 'None', ['option' => 0]);

        foreach ($this->methods as $method) {
            $options .= Html::tag('option', $method['title'], ['option' => $method['id']]);
        }

        $html = Html::tag('select', $options, ['class' => 'f-select', 'id' => 'banking', 'style' => 'width: 160px;']);

        echo $html;
    }
}