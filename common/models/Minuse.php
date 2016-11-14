<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "minuses".
 *
 * @property integer $id
 * @property string $title
 */
class Minuse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'minuses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
            ['title_description', 'string', 'max' => 60],
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
       public function getReviews()
    {
        return $this->hasMany(Review::className(), ['id' => 'review_id'])
                    ->viaTable('review_minus', ['minus_id' => 'id']);
    }
}
