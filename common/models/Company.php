<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Url;
use yii\web\UploadedFile;

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
    public $reviewIds;
    public $logoFile;
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
            [['logo'], 'string', 'max' => 255],
            [['site_url'], 'string', 'max' => 255],
            [['logoFile'], 'safe'],
            [['reviewIds'], 'safe'],
            [['logoFile'], 'file', 'extensions'=>'jpg, gif, png'],
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

    // for relation with reviews
    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['id' => 'review_id'])
                    ->viaTable('company_review', ['company_id' => 'id']);
    }
}