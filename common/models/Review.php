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
            'description' => 'Description'
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
}
