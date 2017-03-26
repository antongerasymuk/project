<?php

namespace common\widgets;


use yii\base\Widget;
use yii\helpers\Html;

class ExternalRefButton extends Widget
{
    public $result;
    public $model;
    public $giftIcon = false;
    public $text = null;
    public $btn_class = null;
    public $relative = true;

    public function init()
    {
        parent::init();
        if (gettype($this->model) == object) {
            if (($this->result === null)&&(($this->model->className() == 'common\models\Bonus')||($this->model->className() == 'common\models\Company'))) {
                

                if ($this->model->rel) {
                    $this->model->rel = 'nofollow';
                } else {
                    $this->model->rel = null;
                }

                switch ($this->model->className()) {
                    case 'common\models\Bonus':

                        $url = $this->model->referal_url;
                        if ($this->model->hide_ext_url) {
                            $url = '/';
                        }
                        break;
                    case 'common\models\Company':
                        
                        $url = $this->model->site_url;
                        if ($this->model->hide_ext_url) {
                            $url = '/';
                        }
                        break;
                }

                if ($this->relative) {
                    $this->relative = "position:relative;";
                } 
 
                if ($this->giftIcon) {
                    $giftHTML = '<i class="flaticon-gift"></i>';
                }

                $this->result = '<a href="'.$url.'" rel="'.$this->model->rel.'" target="_blank"><button type="button" style="'. $this->relative.'" class="get-bonus '.$this->btn_class.'">'
                    .$giftHTML
                    .$this->text
                    .'</button></a>';


            } else  {
                throw new \yii\base\Exception( "Model not an object of common\models\Bonus or common\models\Company!" );
            }
        } else {
            throw new \yii\base\Exception( "Model not an object!" );
        }
    }

    public function run()
    {
        return $this->result;
    }
}