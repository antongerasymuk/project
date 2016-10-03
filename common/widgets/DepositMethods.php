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
        $html = $options = '';

        foreach ($this->methods as $method) {
            $options .= Html::tag('option', $method['title'], ['option' => $method['id']]);
        }

        $html = Html::tag('select', $options, ['class' => 'f-select', 'style' => 'width: 160px;']);

        echo $html;
    }
}