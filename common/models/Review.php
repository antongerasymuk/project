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
            [['bonusIds'], 'safe'],
            [['plusIds'], 'safe'],
            [['reviewIds'], 'safe'],
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
}
