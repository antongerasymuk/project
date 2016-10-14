<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "os".
 *
 * @property integer $id
 * @property string $title
 */
class Os extends \yii\db\ActiveRecord
{
    public $logoFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 10],
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
        ];
    }

    public static function getArr()
    {
        $prosData = Os::find()
                             ->select('id, title')
                             ->asArray()
                             ->all();

        return ArrayHelper::map($prosData, 'id', 'title');
    }
    
    // for relations with  reviews


    public function getOsesReview()
    {
        return $this->hasMany(Review::className(), ['id' => 'review_id'])
                    ->viaTable('os_review', ['os_id' => 'id']);
    }
 
    
    // for relations with  bonuses
    public function getOsesBonus()
    {
        return $this->hasMany(Bonus::className(), ['id' => 'bonus_id'])
                    ->viaTable('os_bonus', ['os_id' => 'id']);
    }
}
