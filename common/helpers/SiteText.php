<?php
namespace common\helpers;

use \common\models\Site; 

class SiteText
{
    public static function get($category) {
        $site = Site::find()->where(['slug' => '-', 'title' => '-', 'category' => $category])->one();

        if ($site) {
          return $site->content;
        } else {
          return false;
        }
    }
}

