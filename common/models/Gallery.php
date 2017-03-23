<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Url;
use common\helpers\ImageNameHelper;

use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;
 

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
            [['src','scr_mini'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'src' => 'Source',
            'scr_mini' => 'Mini screen'
        ];
    }

    public static function upload(array $files)
    {
        $galleryIds = [];
        $gallery = null;

        foreach ($files as $file) {

            $baseName = ImageNameHelper::getImageName($file);
            $baseNameMini = ImageNameHelper::getImageName($file, 'mini');
                       
            $path = Url::to(Yii::$app->params['uploadPath']) . $baseName;
            $pathMini =  Url::to(Yii::$app->params['uploadPath']) . $baseNameMini;
            
            $url =  Url::to(Yii::$app->params['uploadUrl']) . $baseName;
            $urlMini =  Url::to(Yii::$app->params['uploadUrl']) . $baseNameMini;
            
            
            $file->saveAs($path, false);
            $gallery = new self();

            if (is_file($path)) {

                $imageMini = Image::getImagine()->open($path)->thumbnail(new Box('300', '225'));
                
                if ($imageMini->save($pathMini , ['quality' => 90])) {
                    
                    $gallery->scr_mini = $urlMini;
                    $gallery->src = $url;

                    if ($gallery->save()) {
                       $galleryIds[] = $gallery->id;
                    }
                }
            }

            $gallery = null;
        }
 
        return $galleryIds;
    }

  
}
