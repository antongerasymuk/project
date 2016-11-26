<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Url;

/**
 * This is the model class for table "categories".
 *
 * @property integer $id
 * @property string $title
 * @property integer $company_id
 */
class Gallery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gallery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['src'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'src' => 'Source'
        ];
    }

    public static function upload(array $files)
    {
        $galleryIds = [];
        $gallery = null;

        foreach ($files as $file) {
            
            $path = Url::to(Yii::$app->params['uploadPath']) . $file->baseName . '.' . $file->extension;
            $url =  Url::to(Yii::$app->params['uploadUrl']) . $file->baseName . '.' . $file->extension;
            
            $file->saveAs($path, false);
            $gallery = new self();

            if (file_exists($path)) {

                $gallery->src = $url;

                if ($gallery->save()) {
                    $galleryIds[] = $gallery->id;
                }
             
            }
            $gallery = null;
        }
 
        return $galleryIds;
    }

  
}
