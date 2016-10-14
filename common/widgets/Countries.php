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
        parent::init();

        $this->countries = Country::find()->asArray()->all();
    }

    public function run()
    {
        $html = $options = '';

        $options .= Html::tag('option', 'None', ['option' => 0]);

        if (!empty($this->countries)) {
            $ip = Yii::$app->geoip->ip();

            foreach ($this->countries as $country) {
                $optionArr = ['option' => $country['id']];

                if ($ip->country == $country['title']) {
                    $optionArr['selected'] = 'selected';
                }

                $options .= Html::tag('option', $country['title'], $optionArr);
            }
        }

        $html = Html::tag('select', $options, ['class' => 'f-select', 'id' => 'countries', 'style' => 'width: 200px;']);

        echo $html;
    }
}