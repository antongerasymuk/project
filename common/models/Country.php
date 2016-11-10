<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "countries".
 *
 * @property integer $id
 * @property string $title
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'countries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'string']
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
        $prosData = Country::find()
                      ->select('id, title')
                      ->asArray()
                      ->all();

        return ArrayHelper::map($prosData, 'id', 'title');
    }

    public function getReviewsAllowed()
    {
        return $this->hasMany(Review::className(), ['id' => 'review_id'])
                    ->viaTable('allowed_country', ['country_id' => 'id']);
    }

    public function getReviewsDenied()
    {
        return $this->hasMany(Review::className(), ['id' => 'review_id'])
                    ->viaTable('denied_country', ['country_id' => 'id']);
    }

}
