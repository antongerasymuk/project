<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "alternative_sites".
 *
 * @property integer $id
 * @property string $title
 * @property string $url
 * @property string $review_id
 */
class AlternativeSite extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alternative_sites';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['review_id'], 'required'],
            [['title'], 'string', 'max' => 15],
            [['url', 'review_id'], 'string', 'max' => 255],
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
            'url' => 'Url',
            'review_id' => 'Review ID',
        ];
    }
}
