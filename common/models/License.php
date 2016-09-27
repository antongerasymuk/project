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
    public $licenseFile;
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
            [['licenseFile'], 'file', 'skipOnEmpty' => false],
            [['title', 'url'], 'required'],
            [['title'], 'string', 'max' => 25],
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
        ];
    }
}
