<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "rating".
 *
 * @property integer $id
 * @property string $title
 * @property integer $mark
 */
class Rating extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ratings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mark'], 'double', 'min' => 1, 'max' => 10],
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'mark' => 'Mark',
        ];
    }

    public static function getArr()
    {
        $ratingsData = Rating::find()
                                   ->select('id, title')
                                   ->asArray()
                                   ->all();
        return ArrayHelper::map($ratingsData, 'id', 'title');
    }
}
