<?php
namespace common\widgets;

use Yii;
use yii\bootstrap\Nav;

class FooterNav extends Nav
{
    
    
    public function init()
    {
 
     
        for ($i = 1; $i < count($this->items); $i++) {
        $inserted = array( '<li><span>·</span></li>' ); // Not necessarily an array
        array_splice($this->items, $i, 0, $inserted); 
        $i++;
        }
        foreach ( $this->items as $key => $item) {
         
        if (is_array ($this->items[$key])) {
        $this->items[$key]['url'] = '/page/'.$this->items[$key]['url']; 
        }
               
        }
       
       

        parent::init();

        if ($this->route === null && Yii::$app->controller !== null) {
            $this->route = Yii::$app->controller->getRoute();
        }
        if ($this->params === null) {
            $this->params = Yii::$app->request->getQueryParams();
        }
        if ($this->dropDownCaret === null) {
            $this->dropDownCaret = '<span class="caret"></span>';
        }

        unset($this->options['class']);
    } 
}