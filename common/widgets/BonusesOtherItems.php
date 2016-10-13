<?php

namespace common\widgets;


use yii\base\Widget;
use yii\helpers\Html;

class BonusesOtherItems extends Widget
{
    public $message;
    public $items;
    public function init()
    {
        parent::init();
        if ($this->message === null) {
            foreach ($this->items as $item) {
                $this->message .= '<div class="item">
                <div class="tit">'.ucfirst($item['label']).' Bonuses</div>
                <ul>
                    <li><a href="/'.$item['url'][0].'?id='.$item['url']['id'].'&filter_by=1&sort_by=1">'.ucfirst($item['label']).' Sites</a></li>
                    <li><a href="/'.$item['url'][0].'?id='.$item['url']['id'].'&filter_by=0&sort_by=1">No Deposit</a></li>
                    <li><a href="/'.$item['url'][0].'?id='.$item['url']['id'].'&filter_by=2&sort_by=1">Codes</a></li>
                </ul>
                </div>';

        }

    }
}

public function run()
{
    return $this->message;
}
}