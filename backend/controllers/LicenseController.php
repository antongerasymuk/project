<?php
namespace backend\controllers;

use common\models\License;
use Yii;

/**
 * Company controller
 */
class LicenseController extends BackEndController
{
    public function actionIndex()
    {
        $licenses = License::find()->all();

        return $this->render('index', ['licenses' => $licenses]);
    }

    public function actionEdit($id)
    {
        $model = License::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', 'License update success');

            return $this->redirect(['license/index']);
        }

        return $this->render('update', ['model' => $model]);
    }

    public function actionCreate($isAjax = true)
    {
        $model = new License();

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

            Yii::$app->getSession()->setFlash('success', 'License created success');

            return $this->redirect(['license/index']);
        }

        return $this->render('create', ['model' => $model]);
    }
      public function actionDelete($id)
    {
       $model = License::findOne($id);
       $model->unlinkAll('companies',true);
       $model->delete();
       
       Yii::$app->getSession()->setFlash('success', 'success of deleting '.$model->title);
       return $this->redirect(['setting/index']);
    }
}