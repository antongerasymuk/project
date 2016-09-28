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
            [['type'], 'boolean'],
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

    public static function getArr()
    {
        $bonusesData = Bonus::find()
                            ->select('id, title')
                            ->asArray()
                            ->all();
        return ArrayHelper::map($bonusesData, 'id', 'title');
    }

    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['id' => 'bonus_id'])
                    ->viaTable('review_bonus', ['review_id' => 'id']);
    }
}
