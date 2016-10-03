<?php
namespace common\widgets;

use common\models\Country;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class Countries extends Widget
{
    public $countries;
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub

        $this->countries = Country::find()->asArray()->all();
    }

    public function run()
    {
        $html = $options = '';
        // Test country
        $options .= Html::tag('option', 'Ukraine', ['option' => 1]);

        if (!empty($this->countries)) {
            foreach ($this->countries as $country) {
                foreach ($this->methods as $method) {
                    $options .= Html::tag('option', $method['title'], ['option' => $method['id']]);
                }
            }
        }

        $html = Html::tag('select', $options, ['class' => 'f-select', 'style' => 'width: 200px;']);

        echo $html;
    }
}