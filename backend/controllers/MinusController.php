<?php
namespace backend\controllers;

use common\models\Company;
use common\models\Minuse;
use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * Minus controller
 */
class MinusController extends BackEndController
{
    public function actionIndex()
    {
        $minuses = Minuse::find()->all();

        return $this->render('index', ['minuses' => $minuses]);
    }

    public function actionCreate($isAjax = true)
    {
        $model = new Minuse();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($isAjax) {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

                return [
                    'success' => $model->id,
                    'item' => [
                        'id' => $model->id,
                        'value' => $model->title
                    ]
                ];
            }

            Yii::$app->getSession()->setFlash('success', 'Review minus created success');

            return $this->redirect(['minus/index']);
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionEdit($id)
    {
        $model = Minuse::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', 'Review minus updated success');

            return $this->redirect(['minus/index']);
        }

        return $this->render('update', ['model' => $model]);
    }
}