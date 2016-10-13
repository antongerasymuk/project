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
    public $reviewIds;
    public $logoFile;
    public $licenseIds;
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
            [['title', 'site_url', 'director_id', 'address', 'rating'], 'required'],
            ['rating', 'double'],
            [['site_url'], 'url', 'validSchemes' => ['http', 'https']],
            [['reviewIds', 'licenseIds'], 'safe'],
            [['description'], 'string'],
            [['bg_color'], 'default', 'value' => '#000'],
            [['logoFile'], 'file', 'skipOnEmpty' => false, 'extensions'=>'jpg, gif, png', 'except' => 'edit']
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
            'director_id' => 'Director'
		];
	}


//    public function behaviors()
//    {
//        return [
//            TimestampBehavior::className(),
//        ];
//    }

    // for relation with reviews
    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['company_id' => 'id']);
    }

    public function getDirector()
    {
        return $this->hasOne(Director::className(), ['director_id' => 'id']);
    }

    public function getLicenses()
    {
        return $this->hasMany(License::className(), ['id' => 'license_id'])
            ->viaTable('company_license', ['company_id' => 'id']);
    }

    public static function getRelatedReviews($company_id, $current_review_id)
    {
        return Company::find()
            ->select('id')
            ->with(['reviews' => function($query) use ($current_review_id){
                $query
                    ->with(['bonuses' => function($query){
                        $query->where(['type' => 1])->one();
                    }])
                    ->where(['<>', 'id', $current_review_id])
                    ->andWhere(['type' => Review::REVIEW]);
            }])
            ->where(['id' => $company_id])
            ->asArray()
            ->one();
    }

    public function scenarios()
    {
        return parent::scenarios();
    }
}