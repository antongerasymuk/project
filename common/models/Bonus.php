<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "bonuses".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $logo
 * @property double $price
 * @property string $code
 * @property string $referal_url
 * @property integer $type
 */
class Bonus extends \yii\db\ActiveRecord
{
    const MAIN = 1;
    public $logoFile;
    public $reviewIds;
    public $osIds;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bonuses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            ['title_description', 'string', 'max' => 60],
            [['description'], 'string'],
            [['check_dep'], 'integer', 'max'=> 2],
            [['check_no_dep'], 'integer', 'max'=> 2],
            [['price'], 'number'],
            [['percent'], 'number', 'max' => 10000],
            [['rollover_title'], 'string', 'max' => 25],
            [['reviewIds'], 'safe'], 
            [['osIds'], 'safe'],
            [['review_id'], 'integer'],
            [['percent'], 'number'],
            [['currency'], 'string', 'max' => 1],
            [['type'], 'default', 'value' => 0],
            [['type'], 'in', 'range' => [0, Bonus::MAIN]],
            [['min_deposit'], 'number'],
            [['expiry'], 'string', 'max' => 50 ],
            [['rollover_requirement'], 'string'],
            [['restrictions'], 'string'],
            [['title'], 'string', 'max' => 50],
            [['logo', 'referal_url'], 'string', 'max' => 255],
            ['rel', 'integer'],
            [['referal_url'], 'url', 'validSchemes' => ['http', 'https']],
            ['hide_ext_url', 'integer', 'max' => 3],
            [['code'], 'string', 'max' => 15],
            [['logoFile'], 'safe'],
            [['bg_color'], 'default', 'value' => '#000'],
            [['logoFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg, gif, png'],
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
            'osIds' => 'Compatible With',
            'description' => 'Description',
            'logo' => 'Logo',
            'price' => 'Price',
            'code' => 'Code',
            'referal_url' => 'Referal Url',
            'type' => 'Type',
            'min_deposit' => 'Minimum Deposit',
            'expiry' => 'Expiry',
            'rollover_requirement' => 'Rollover Requirement',
            'restrictions' => 'Restrictions',
            'hide_ext_url' => 'Hide external URL'
        ];
    }

    public function getReview()
    {
        return $this->hasOne(Review::className(), ['id' => 'review_id']);
    }
}
