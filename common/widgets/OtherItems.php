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

            $contactUs[0] = [
              'label' => 'Contact Us',
              'url' => 'contact'
            ];

            $home[0] = [
              'label' => 'Home',
              'url' => 'home'
            ];

            $this->items = array_merge($contactUs, $this->items, $home); 
            $this->message .='<div class="item"><div class="tit">'.'Navigation'.'</div><ul>';
            
            foreach ($this->items as $key =>  $item) {
   
                $this->message .= '           
                
                    <li><a href="'.((mb_strtolower($item['url']) != 'home')? mb_strtolower($item['url']):'/').'">'.ucfirst($item['label']).'</a></li>';
       
            }
            $this->message .= '</ul></div>';

    }
}

public function run()
{
    return $this->message;
}
}