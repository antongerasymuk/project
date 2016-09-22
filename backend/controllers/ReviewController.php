<?php
namespace backend\controllers;

use common\models\Company;
use common\models\Review;
use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * Company controller
 */
class ReviewController extends BackEndController
{
    public function actionIndex()
    {

    }

    public function actionCreate()
    {
        $model = new Review();

        if ($model->load(Yii::$app->request->post())) {
            // review save
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            return ['success' => $model->save()];
        }

        return $this->renderAjax('create', ['model' => $model]);
    }

    public function editCreate()
    {

    }
}