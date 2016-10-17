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
    public function actionIndex()
    {
        $pluses = Plus::find()->all();

        return $this->render('index', ['pluses' => $pluses]);
    }
    public function actionCreate($isAjax = true)
    {
        $model = new Plus();

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

            Yii::$app->getSession()->setFlash('success', 'Review plus created success');

            return $this->redirect(['plus/index']);
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionEdit($id)
    {
        $model = Plus::findOne($id);

        if ($model->load(Yii::$app->request->post())  && $model->save()) {
            Yii::$app->getSession()->setFlash('success', 'Review plus updated success');

            return $this->redirect(['plus/index']);
        }

        return $this->render('update', ['model' => $model]);
    }
    public function actionDelete($id)
    {
       $model = Plus::findOne($id);
       $model->delete();
       $model->unlinkAll('reviews',true);

       Yii::$app->getSession()->setFlash('success', 'success of deleting '.$model->title);
       return $this->redirect(['plus/index']);
    }
}