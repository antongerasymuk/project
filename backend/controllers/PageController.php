<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class PageController extends BackEndController
{
	public function actionIndex()
	{
		return $this->render('index');
	}
}