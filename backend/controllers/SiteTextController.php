<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Site;
use backend\models\SiteTextForm;

/**
 * SiteText controller
 */
class SiteTextController extends BackEndController
{
	
	public function actionEdit()
	{
		
		$model = new SiteTextForm;
		$model->get();
		if (($model->load(Yii::$app->request->post()))&&($model->save())) {
			{         
				Yii::$app->getSession()->setFlash('success', 'Site texts update success');
				return $this->redirect(['site-text/edit']);
			}
		}

		return $this->render('update', ['model' => $model]);
	}
	
	
}