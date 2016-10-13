<?php
namespace backend\controllers;

use common\models\Os;
use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * Company controller
 */
class OsController extends BackEndController
{
    public function actionIndex()
    {
        return $this->render('index', [
            'oses' => Os::find()->all()
        ]);
    }

    public function actionCreate()
    {
        $model = new Os();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', 'Os created success');

            return $this->redirect(['os/index']);
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionEdit($id)
    {
        $model = Os::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', 'Os update success');

            return $this->redirect(['os/index']);
        }

        return $this->render('update', ['model' => $model]);
    }

}