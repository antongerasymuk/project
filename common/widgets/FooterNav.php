<?php
namespace common\widgets;

use Yii;
use yii\bootstrap\Nav;

class FooterNav extends Nav
{
    
    public $items = array();
    public function init()
    {
        
        $this->items = array();
        $this->items[]  = ['label' => 'Contact Us',
                           'url' =>'/site/contact'];
        $this->items[]  = '<li><span>·</span></li>';
        $this->items[]  = ['label' => 'Privacy',
                           'url' =>'/site/privacy'];
        $this->items[]  = '<li><span>·</span></li>';
        $this->items[]  = ['label' => 'Terms and Conditions',
                           'url' =>'/site/terms_and_conditions'];
        $this->items[]  = '<li><span>·</span></li>';
        $this->items[]  = ['label' => 'Site Map',
                           'url'=>'/site/site_map'];
        $this->items[]  = '<li><span>·</span></li>'; 
        $this->items[]  = ['label' => 'Glossary',
                           'url' =>'/site/glossary']; 

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