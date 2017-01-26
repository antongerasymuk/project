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
    const REVIEW_TYPE = 1;
    const COMPANY_TYPE = 2;
    public $bonusIds;
    public $gallery;
    public $logoFile;
    public $galleryIds;
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
            [['title', 'preview_title', 'address', 'type'], 'required'],
            ['title_description', 'string', 'max' => 60],
            [['type'], 'default', 'value' => self::REVIEW_TYPE],
            ['slug', 'string', 'max' => 60],
            ['description', 'string'],
            [['position'], 'string', 'max' => 40],
            [['company_id', 'category_id'], 'integer'],
            [['type'], 'in', 'range' => [self::REVIEW_TYPE, self::COMPANY_TYPE]],
            [
                [
                    'bonusIds',
                    'galleryIds',
                    'ratingIds',
                    'plusIds',
                    'minusIds',
                    'depositIds',
                    'osIds',
                    'allowedIds',
                    'deniedIds'
                ],
                'safe'
            ],
            [
                ['previewFile', 'logoFile'],
                'file',
                'skipOnEmpty' => false,
                'extensions' => ['jpg', 'png', 'gif'],
                'except' => 'edit'
            ],
            ['gallery', 'file', 'extensions' => ['jpg', 'gif', 'png'], 'maxFiles' => 4],
            [['bg_color'], 'default', 'value' => '#000'],
            [['preview', 'logo', 'preview_title', 'address'], 'string']
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
            'logoFile' => 'Logo file',
            'category_id' => 'Category',
            'preview_title' => 'Preview Title',
            'description' => 'Description',
            'alias_category' => 'Category Alias',
            'depositIds' => 'Deposit methods',
            'osIds' => 'Compatible With',
            'allowedIds' => 'Allowed countries',
            'deniedIds' => 'Denied countries'
        ];
    }

    // for relation with bonuses
    public function getBonuses()
    {
        return $this->hasMany(Bonus::className(), ['review_id' => 'id']);
    }

    // for relation with rating
    public function getRatings()
    {
        return $this->hasMany(Rating::className(), ['id' => 'rating_id'])
            ->viaTable('review_rating', ['review_id' => 'id']);
    }

    public function getMainBonus()
    {
        $bonus = Bonus::findOne(['review_id' => $this->id, 'type' => Bonus::MAIN]);

        return $bonus == null ? new Bonus() : $bonus;
    }

    // for relation with pluses

    public function getPluses()
    {
        return $this->hasMany(Plus::className(), ['id' => 'plus_id'])
            ->viaTable('review_plus', ['review_id' => 'id']);
    }

    // for relation with minuses
    public function getMinuses()
    {
        return $this->hasMany(Minuse::className(), ['id' => 'minus_id'])
                    ->viaTable('review_minus', ['review_id' => 'id']);
    }

    public function getDeposits()
    {
        return $this->hasMany(DepositMethod::className(), ['id' => 'dep_id'])
            ->viaTable('review_dep_method', ['review_id' => 'id']);
    }

    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }

    public function getOses()
    {
        return $this->hasMany(Os::className(), ['id' => 'os_id'])
                    ->viaTable('os_review', ['review_id' => 'id']);
    }

    public function getAllowed()
    {
        return $this->hasMany(Country::className(), ['id' => 'country_id'])
                    ->viaTable('allowed_country', ['review_id' => 'id']);
    }

    public function getDenied()
    {
        return $this->hasMany(Country::className(), ['id' => 'country_id'])
                    ->viaTable('denied_country', ['review_id' => 'id']);
    }

    public function getGalleries()
    {
        return $this->hasMany(Gallery::className(), ['id' => 'gallery_id'])
                    ->viaTable('review_gallery', ['review_id' => 'id']);
    }
    
    public function getCategory()
    {
        return $this->hasOne(Categorie::className(), ['id' => 'category_id']);
    }

    public function getRelated($limit = null)
    {
        $reviews = self::find()
            ->where(['company_id' => $this->company_id])
            ->andWhere(['type' => self::REVIEW_TYPE])
            ->andWhere(['<>', 'id', $this->id]);

        if ($limit != null && is_numeric($limit)) {
            $reviews->limit($limit);
        }

        return $reviews->all();
    }

    public function getReviews($limit = null)
    {
        $reviews = self::find()->select(['id','category_id'])
            ->where(['company_id' => $this->company_id])
            ->andWhere(['type' => self::REVIEW_TYPE])->with('category');

        if ($limit != null && is_numeric($limit)) {
            $reviews->limit($limit);
        }

        return $reviews->all();
    }

    public function getTop($limit = 5)
    {
        $reviews = Review::find()
            ->where(['<>', 'id', $this->id])
            ->andWhere(['category_id' => $this->category_id])
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

                if (!empty($reviews[$i]['ratings'])) {
                    $reviews[$i]['ratings'] = $sum / $count;
                } else {
                    $reviews[$i]['ratings'] = 0;
                }
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
