<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reviews".
 *
 * @property integer $id
 * @property string $logo
 * @property integer $category_id
 * @property string $adress
 */
class Review extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reviews';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['category_id', 'title'], 'required'],
//            [['category_id'], 'integer'],
//            [['logo'], 'string', 'max' => 255],
            [['title'], 'string', 'max' => 255],
            [['address'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
//            'logo' => 'Logo',
//            'category_id' => 'Category ID',
            'address' => 'Address',
        ];
    }
}
