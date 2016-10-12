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
	public function actionCreate()
	{
		$model = new Site();

		if (($model->load(Yii::$app->request->post()))&&($model->save())) {

			Yii::$app->getSession()->setFlash('success', 'Page created success');
			return $this->redirect(['page/index']);

		}

		return $this->render('create', ['model' => $model]);
	}
	public function actionEdit($id)
	{
		$model = Site::findOne($id);

		if (($model->load(Yii::$app->request->post()))&&($model->save())) {
			{         
				Yii::$app->getSession()->setFlash('success', 'Review update success');

				return $this->redirect(['page/index']);
			}
		}

		return $this->render('update', ['model' => $model]);
	}
}