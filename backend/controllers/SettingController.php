<?php
namespace backend\controllers;

use common\models\User;

class SettingController extends BackEndController
{
    public function actionIndex()
    {
        $users = User::find()->all();

        return $this->render('index', ['users' => $users]);
    }

    public function actionEdit($id)
    {
        $model = User::findOne($id);

        if ($model->load(\Yii::$app->request->post())) {
            $model->setPassword($model->password);

            if ($model->save()) {
                \Yii::$app->getSession()->setFlash('success', 'Administrator updated success');

                return $this->redirect(['setting/index']);
            }
        }

        return $this->render('update', ['model' => $model]);
    }

    public function actionCreate()
    {
        $model = new User();

        if ($model->load(\Yii::$app->request->post())) {
            $model->email = $model->username;
            $model->setPassword($model->password);

            if ($model->save()) {
                \Yii::$app->getSession()->setFlash('success', 'Administrator create success');

                return $this->redirect(['setting/index']);
            }
        }

        return $this->render('create', ['model' => $model]);
    }
    public function actionDelete($id)
    {
       $model = User::findOne($id);
       $model->delete();

       Yii::$app->getSession()->setFlash('success', 'success of deleting '.$model->title);
       return $this->redirect(['setting/index']);
    }
}