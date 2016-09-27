<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "deposit_methods".
 *
 * @property integer $id
 * @property string $logo
 * @property string $title
 */
class DepositMethod extends \yii\db\ActiveRecord
{
    public $logoFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'deposit_methods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['logo'], 'string', 'max' => 255],
            ['title', 'required'],
            [['title'], 'string', 'max' => 15],
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
            'logo' => 'Logo',
            'title' => 'Title',
        ];
    }
}
