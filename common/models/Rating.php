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

    public function getReviews()
    {
        return $this->hasMany(Rating::className(), ['id' => 'review_id'])
            ->viaTable('review_rating', ['rating_id' => 'id']);
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
}
