<?php
namespace backend\controllers;

use common\models\Company;
use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * Company controller
 */
class CategoryController extends BackEndController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}