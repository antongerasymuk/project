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
    public $previewFile;
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
            [['title'], 'required'],
            [['description'], 'string'],
//            [['category_id'], 'integer'],
//            [['logo'], 'string', 'max' => 255],
            [['title'], 'string', 'max' => 255],
            [['address'], 'string', 'max' => 100],
            [['preview'], 'string'],
            [['previewFile'], 'safe'],
            [['previewFile'], 'file', 'extensions'=>'jpg, gif, png'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'address' => 'Address',
            'preview' => 'Preview',
            'description' => 'Description'
        ];
    }
}
