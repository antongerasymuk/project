<?php

namespace common\widgets;


use yii\base\Widget;
use yii\helpers\Html;

class OtherItems extends Widget
{
    public $message;
    public $items;
    public function init()
    {
        parent::init();
        if ($this->message === null) {

            foreach ($this->items as $key =>  $item) {
                if ($key != 'footer') {
                $this->message .='<div class="item"><div class="tit">'.ucfirst($key).'</div>
                <ul>';
                foreach ($item as $row) {

                $this->message .= '           
                
                    <li><a href="'.((mb_strtolower($row['url']) != 'home')? mb_strtolower($row['url']):'/').'">'.ucfirst($row['label']).'</a></li>';
       
                 }   
                $this->message .= '</ul>
                </div>';}

        }

    }
}

public function run()
{
    return $this->message;
}
}