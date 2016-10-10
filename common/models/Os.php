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
            [['logoFile'], 'safe'],
            [['src'], 'string'],
            [['logoFile'], 'file', 'skipOnEmpty' => false, 'extensions' => ['jpg', 'png', 'gif'], 'except' => 'edit'],
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
}
