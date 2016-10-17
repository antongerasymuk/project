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
        $ratings = Rating::find()->all();
        return $this->render('index', ['ratings' => $ratings]);
    }

    public function actionEdit($id)
    {
        $model = Rating::findOne($id);

        if (($model->load(Yii::$app->request->post()))&&($model->save())) {
            {         
                Yii::$app->getSession()->setFlash('success', 'Rating update success');

                return $this->redirect(['rating/index']);
            }
        }

        return $this->render('update', ['model' => $model]);
    }

    public function actionCreate($isAjax = true)
    {
        $model = new Rating();

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
            Yii::$app->getSession()->setFlash('success', 'Rating created success');

            return $this->redirect(['rating/index']);
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        $model = Rating::findOne($id);
        $model->delete();
        $model->unlinkAll('reviews', true);

        return $this->redirect(['rating/index']);
    }

}