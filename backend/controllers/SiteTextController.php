<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Site;
use backend\models\SiteTextForm;
use common\models\MetaTag;

/**
 * SiteText controller
 */
class SiteTextController extends BackEndController
{
	
	public function actionIndex()
	{
		
		$model = new SiteTextForm;
		$model->getMetaTags();
		$model->get();
		if (($model->load(Yii::$app->request->post()))&&($model->save())) {
			{         
				Yii::$app->getSession()->setFlash('success', 'Site texts update success');
				return $this->redirect(['index']);
			}
		}

		return $this->render('index', ['model' => $model]);
	}
	
	
}