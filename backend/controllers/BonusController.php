<?php
namespace backend\controllers;

use common\models\Bonuse;
use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * Company controller
 */
class BonusController extends BackEndController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreate()
    {
        $model = new Bonuse();

        return $this->renderAjax('create_modal', ['model' => $model]);
    }
}