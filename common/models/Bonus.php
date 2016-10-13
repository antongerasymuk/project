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
            [['description'], 'string'],
            [['price'], 'number'],
            [['reviewIds'], 'safe'], // test
            [['osIds'], 'safe'],
            [['review_id'], 'integer'],
            [['percent'], 'number'],
            [['currency'], 'string', 'max' => 1],
            [['type'], 'default', 'value' => 0],
            [['type'], 'in', 'range' => [0, Bonus::MAIN]],
            [['min_deposit'], 'number'],
            [['expiry'], 'integer'],
            [['rollover_requirement'], 'string'],
            [['restrictions'], 'string'],
            [['title'], 'string', 'max' => 50],
            [['logo', 'referal_url'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 15],
            [['logoFile'], 'safe'],
            [['logoFile'], 'file', 'skipOnEmpty' => true, 'extensions'=>'jpg, gif, png'],
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
            'restrictions' => 'Restrictions'
        ];
    }

    public function getReview()
    {
        return $this->hasOne(Review::className(), ['id' => 'review_id']);
    }

    public function getOses()
    {
        return $this->hasMany(Os::className(), ['id' => 'os_id'])
                    ->viaTable('os_bonus', ['bonus_id' => 'id']);
    }
}
