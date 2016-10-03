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
    public $gallery;
    public $galleryIds;
    public $previewFile;
    public $ratingIds;
    public $plusIds;
    public $minusIds;
    public $depositIds;
    public $osIds;
    public $allowedIds;
    public $deniedIds;
    public $categoryId;
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
            [['preview_title'], 'string', 'max' => 255 ],
            [['previewFile'], 'safe'],
            [['gallery'], 'safe'],
            [['gallery'], 'file', 'extensions'=>'jpg, gif, png', 'maxFiles' => 3],
//            [['ratingIds'], 'each', 'rule' => 'integer'],
//            [['galleryIds'], 'each', 'rule' => 'integer'],
            [['ratingIds'], 'safe'],
            [['minusIds', 'depositIds', 'osIds'], 'safe'],
            [['bonusIds'], 'safe'],
            [['categoryId'], 'required'],
            [['categoryId'], 'integer', 'min' => 1],
            [['plusIds'], 'safe'],
            [['previewFile'], 'safe'],
            [['previewFile'], 'file', 'skipOnEmpty' => true, 'extensions'=>'jpg, gif, png'],
            [
                [
                    'bonusIds',
                    'ratingIds',
                    'plusIds',
                    'minusIds',
                    'depositIds',
                    'osIds',
                    'allowedIds',
                    'deniedIds',
                ],
                'default',
                'value' => []
            ]
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
            'preview_title' => 'Preview Title',
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
        return $this->hasMany(Pros::className(), ['id' => 'pos_id'])
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
        return $this->hasMany(Os::className(), ['id' => 'os_id'])
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

    public function getGallery()
    {
        return $this->hasMany(Gallery::className(), ['id' => 'gallery_id'])
                    ->viaTable('review_gallery', ['review_id' => 'id']);
    }

    public function getCategory()
    {
        return $this->hasOne(Categorie::className(), ['id' => 'category_id']);
    }

    public static function getTop($category_id, $current_review_id, $limit = 5)
    {
        $reviews = Review::find()->select('id, title')
            ->where(['<>', 'id', $current_review_id])
            ->andWhere(['category_id' => $category_id])
            ->with('ratings')
            ->asArray()->all();

        $length = count($reviews);
        $sum = $count = 0;

        for ($i = 0; $i < $length; $i++) {
            if (isset($reviews[$i]['ratings'])) {
                $count = count($reviews[$i]['ratings']);

                foreach ($reviews[$i]['ratings'] as $rating) {
                    $sum += $rating['mark'];
                }

                $reviews[$i]['ratings'] = $sum / $count;
                $sum = $count = 0;
            }
        }

        usort($reviews, function($a, $b){
            if ($a['ratings'] < $b['ratings']) return 1;
            if ($a['ratings'] > $b['ratings']) return -1;

            return 0;
        });

        return array_slice($reviews, 0, $limit, true);
    }
}
