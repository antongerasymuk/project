<?php

namespace common\models;

use Yii;

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
        return 'rating';
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
}
