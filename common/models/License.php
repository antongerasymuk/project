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
            ['title_description', 'string', 'max' => 60],
            ['url', 'url', 'validSchemes' => ['http', 'https']],
            [['title'], 'string', 'max' => 25],
            [['file_label'], 'string', 'max' => 25],
            [['url'], 'string', 'max' => 150],

            ['rel', 'integer'],
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
    public function getCompanies()
    {
        return $this->hasMany(License::className(), ['id' => 'company_id'])
            ->viaTable('company_license', ['license_id' => 'id']);
    }
}
