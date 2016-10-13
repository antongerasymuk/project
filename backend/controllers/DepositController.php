<?php
namespace backend\controllers;

use common\models\DepositMethod;
use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * Deposit controller
 */
class DepositController extends BackEndController
{
    public function actionCreate()
    {
        $model = new DepositMethod();

        if ($model->load(Yii::$app->request->post())) {
            $params = Yii::$app->params;

            $model->logoFile = UploadedFile::getInstance($model, 'logoFile');
            $path = Url::to($params['uploadPath']) . $model->logoFile->baseName . '.' . $model->logoFile->extension;

            // store the source file name
            $model->logo = $params['uploadUrl'] . $model->logoFile->baseName . '.' . $model->logoFile->extension;

            if ($model->save()) {
                $model->logoFile->saveAs($path);
            }

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