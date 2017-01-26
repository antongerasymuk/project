<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "site_numbers".
 *
 * @property integer $id
 * @property integer $type
 * @property string $value
 */
class SiteNumber extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'site_numbers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'integer'],
            [['value'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'value' => 'Value',
        ];
    }
}
