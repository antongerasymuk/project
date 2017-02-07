<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "meta_tags".
 *
 * @property integer $id
 * @property string $tag
 * @property string $value
 * @property integer $review_id
 * @property integer $category_id
 * @property integer $type
 */
class MetaTag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'meta_tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value'], 'string'],
            [['review_id', 'category_id', 'type'], 'integer'],
           // [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categorie::className(), 'targetAttribute' => ['category_id' => 'id']],
            //[['review_id'], 'exist', 'skipOnError' => true, 'targetClass' => Review::className(), 'targetAttribute' => ['review_id' => 'id']],
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Categorie::className(), ['id' => 'category_id']);
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'value' => 'Value',
            'review_id' => 'Review ID',
            'category_id' => 'Category ID',
            'type' => 'Type',
        ];
    }
}
