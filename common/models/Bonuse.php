<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bonuses".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $logo
 * @property double $price
 * @property string $code
 * @property string $referal_url
 * @property integer $type
 */
class Bonuse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bonuses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['description'], 'string'],
            [['price'], 'number'],
            [['type'], 'integer'],
            [['title'], 'string', 'max' => 50],
            [['logo', 'referal_url'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 15],
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
            'description' => 'Description',
            'logo' => 'Logo',
            'price' => 'Price',
            'code' => 'Code',
            'referal_url' => 'Referal Url',
            'type' => 'Type',
        ];
    }
}
