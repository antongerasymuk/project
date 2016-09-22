<?php
namespace backend\controllers;

use common\models\Company;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Company controller
 */
class CompanyController extends BackEndController
{
	public function actionIndex()
	{
		return $this->render('index');
	}

	public function actionCreate()
	{
        $model = new Company();

	    if ($model->load(Yii::$app->request->post()) && $model->save()) {
	        // Upload company logo
	        if ($model->upload()) {

            }
        }

		return $this->render('create', ['model' => $model]);
	}

	public function actionUpdate($id)
	{

	}
}