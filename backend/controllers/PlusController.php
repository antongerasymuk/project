<?php
namespace backend\controllers;

use common\models\Company;
use common\models\Plus;
use common\models\Pros;
use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * Company controller
 */
class PlusController extends BackEndController
{
    public function actionCreate()
    {
        $model = new Plus();

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

        return $this->render('create_modal', ['model' => $model]);
    }
}