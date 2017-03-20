<?php
namespace common\helpers;

use \common\models\Site; 

class ImageNameHelper
{
    public static function getImageName(\yii\web\UploadedFile $file, $subString = '') {
      	return preg_replace('/[^a-zA-Z0-9_.]/', '_', $file->baseName) . '_' . strtolower($subString) . time() . '.' . $file->extension;
    }
}