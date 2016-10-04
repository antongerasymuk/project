<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "pros".
 *
 * @property integer $id
 * @property string $title
 */
class Plus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pluses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
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
        ];
    }

    public static function getArr()
    {
        $prosData = Categorie::find()
            ->select('id, title')
            ->asArray()
            ->all();

        return ArrayHelper::map($prosData, 'id', 'title');
    }
}
