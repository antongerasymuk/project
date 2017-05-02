<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "directors".
 *
 * @property integer $id
 * @property string $description
 * @property string $photo
 * @property integer $company_id
 */
class Director extends \yii\db\ActiveRecord
{
    public $photoFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'directors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            ['title_description', 'string', 'max' => 60],
            [['photoFile'], 'file', 'skipOnEmpty' => true, 'extensions'=>'jpg, gif, png', 'except' => 'edit'],
            [['description', 'title'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
            'photo' => 'Photo',
            'title' => 'Title'
        ];
    }
}
