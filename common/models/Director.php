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
            [['company_id'], 'required'],
            [['company_id'], 'integer'],
            [['description', 'photo'], 'string', 'max' => 255],
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
            'company_id' => 'Company ID',
        ];
    }
}
