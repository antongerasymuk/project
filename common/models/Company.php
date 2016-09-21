<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "companies".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $bg_color
 * @property string $logo
 * @property string $site_url
 * @property integer $created_at
 * @property integer $updated_at
 */
class Company extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'companies';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['description'], 'string'],
			[['created_at', 'updated_at'], 'integer'],
			[['title'], 'string', 'max' => 50],
			[['bg_color'], 'string', 'max' => 7],
			[['logo', 'site_url'], 'string', 'max' => 255],
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
			'bg_color' => 'Bg Color',
			'logo' => 'Logo',
			'site_url' => 'Site Url',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		];
	}


    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
}