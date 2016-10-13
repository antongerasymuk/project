<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "licenses".
 *
 * @property integer $id
 * @property string $title
 * @property string $url
 */
class License extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'licenses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'url', 'file_label'], 'required'],
            ['url', 'url', 'validSchemes' => ['http', 'https']],
            [['title'], 'string', 'max' => 25],
            [['file_label'], 'string', 'max' => 25],
            [['url'], 'string', 'max' => 255],
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
            'file_label' => 'Link text'
        ];
    }
}
