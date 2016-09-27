<?php
namespace backend\controllers;

use common\models\Company;
use common\models\Rating;
use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * Company controller
 */
class RatingController extends BackEndController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreate()
    {
        $model = new Rating();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            return [
                'success' => $model->id,
                'item' => [
                    'id' => $model->id,
                    'value' => $model->title
                ]
            ];
        }

        return $this->render('create', ['model' => $model]);
    }
}