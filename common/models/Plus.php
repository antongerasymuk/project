<?php

namespace common\models;
/**
 * This is the model class for table "pros".
 *
 * @property integer $id
 * @property string $title
 */
class Plus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pluses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
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

    // for relation with pros(pluses)

    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['id' => 'review_id'])
            ->viaTable('review_plus', ['plus_id' => 'id']);
    }
}
