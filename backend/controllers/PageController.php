<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Site;

/**
 * Site controller
 */
class PageController extends BackEndController
{
	public function actionIndex()
	{
		 $sites = Site::find()->all();
        return $this->render('index', ['sites' => $sites]);
	}
	 public function actionEdit($id)
    {
        $model = Site::findOne($id);
       // $model->scenario = 'edit';
        //$model->scenario = 'edit';
        //var_dump($model->content);

        if ($model->load(Yii::$app->request->post())) {
            //$model->previewFile = UploadedFile::getInstance($model, 'previewFile');
            //$model->logoFile = UploadedFile::getInstance($model, 'logoFile');
            //$params = Yii::$app->params;

            if ($model->save()) {
            	//var_dump($model);
            	//exit;
                Yii::$app->getSession()->setFlash('success', 'Review update success');

                return $this->redirect(['page/index']);
            }
        }

    

        return $this->render('update', ['model' => $model]);
    }
}