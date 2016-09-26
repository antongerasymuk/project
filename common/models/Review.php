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
    public $bonusIds;
    public $previewFile;
    public $ratingIds;
    public $plusIds;
    public $minusIds;
    public $depositIds;
    public $osIds;
    public $allowedIds;
    public $deniedIds;
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
            [['title'], 'string', 'max' => 255],
            [['address'], 'string', 'max' => 100],
            [['preview'], 'string'],
            [['previewFile'], 'safe'],
            [['ratingIds'], 'safe'],
            [['osIds'], 'default', 'value' => []],
            [['allowedIds'], 'default', 'value' => []],
            [['deniedIds'], 'default', 'value' => []],
            [['minusIds', 'depositIds', 'osIds'], 'safe'],
            [['bonusIds'], 'safe'],
            [['plusIds'], 'safe'],
            [['previewFile'], 'file', 'skipOnEmpty' => true, 'extensions'=>'jpg, gif, png'],
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
            'description' => 'Description',
            'depositIds' => 'Deposit methods',
            'osIds' => 'Compatible With',
            'allowedIds' => 'Allowed countries',
            'deniedIds' => 'Denied countries'
        ];
    }

    // for relation with bonuses
    public function getBonuses()
    {
        return $this->hasMany(Bonus::className(), ['id' => 'bonus_id'])
                    ->viaTable('review_bonus', ['review_id' => 'id']);
    }

    // for relation with rating
    public function getRatings()
    {
        return $this->hasMany(Rating::className(), ['id' => 'rating_id'])
            ->viaTable('review_rating', ['review_id' => 'id']);
    }

    // for relation with pros(pluses)

    public function getPros()
    {
        return $this->hasMany(Pros::className(), ['id' => 'pros_id'])
            ->viaTable('review_pros', ['review_id' => 'id']);
    }

    // for relation with minuses
    public function getMinuses()
    {
        return $this->hasMany(Pros::className(), ['id' => 'minus_id'])
                    ->viaTable('review_minus', ['review_id' => 'id']);
    }

    public function getDeposits()
    {
        return $this->hasMany(DepositMethod::className(), ['id' => 'deposit_id'])
            ->viaTable('review_dep_method', ['review_id' => 'id']);
    }

    public function getOses()
    {
        return $this->hasMany(DepositMethod::className(), ['id' => 'os_id'])
                    ->viaTable('os_review', ['review_id' => 'id']);
    }

    public function getAllowed()
    {
        return $this->hasMany(Country::className(), ['id' => 'country_id'])
                    ->viaTable('allowed_countries', ['review_id' => 'id']);
    }

    public function getDenied()
    {
        return $this->hasMany(Country::className(), ['id' => 'country_id'])
                    ->viaTable('denied_countries', ['review_id' => 'id']);
    }
}
