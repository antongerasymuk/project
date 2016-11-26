<?php
namespace common\helpers;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class ModelMapHelper
{
    public static function get($model, $fields, $key, $value, $value_description)
    {
    
        /**
         * @var $model ActiveRecord
         */
        $model = new $model();
        if ($value_description) {
            $fields = $fields.", title_description";
        }

        $prosData = $model::find()
        ->select($fields)
        ->asArray()
        ->all();
        
        $array = array();
        if ($value_description) {
            array_walk($prosData, function(&$value, $key){
                if($value['title_description']) {
                    $value['title']= $value['title'].': '. $value['title_description'];
                }
            });
            
        }
        return ArrayHelper::map($prosData, $key, $value);
    }

    public static function getIdTitleMap($model, $description = false)
    {
        return self::get($model, 'id, title', 'id', 'title', $description);
    }
}