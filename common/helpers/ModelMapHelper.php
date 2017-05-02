<?php
namespace common\helpers;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class ModelMapHelper
{
    public static function get($model, $fields, $key, $value, $description, $value_description)
    {

        /**
         * @var $model ActiveRecord
         */

        $model = new $model();
        if ($description) {
            if ($value_description) {
                $fields = $fields.", ".$value_description;
                $title_description = $value_description;
            } else {
                $fields = $fields.", title_description";
                $title_description = 'title_description';
            }
        }

        $prosData = $model::find()
            ->select($fields)
            ->asArray()
            ->all();

        $array = array();
        if ($description) {
            array_walk($prosData, function(&$value, $key) use ($title_description) {
                    if($value[$title_description]) {
                        $value['title']= $value['title'].': '. $value[$title_description];
                    }
                });

        }

        return ArrayHelper::map($prosData, $key, $value);
    }

    public static function getIdTitleMap($model, $description = false, $value_description = false )
    {
        return self::get($model, 'id, title', 'id', 'title', $description, $value_description);
    }
}