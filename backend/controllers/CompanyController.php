<?php
namespace backend\controllers;

use common\models\Company;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
 * Company controller
 */
class CompanyController extends BackEndController
{
	public function actionIndex()
	{
	    // get 10 companies
	    $companies = Company::find()->limit(10)->all();

		return $this->render('index', [
		    'companies' => $companies
        ]);
	}

	public function actionCreate()
	{
        $model = new Company();

        if ($model->load(Yii::$app->request->post())) {
            // get the uploaded file instance. for multiple file uploads
            // the following data will return an array
            $logoFile = UploadedFile::getInstance($model, 'logoFile');
            $path = Url::to('@frontend/web/' . Company::LOGO_PATH) . $logoFile->baseName . '.' . $logoFile->extension;

            // store the source file name
            $model->logo = Company::LOGO_PATH . $logoFile->baseName . '.' . $logoFile->extension;

            if($model->save()){
                $logoFile->saveAs($path);
                // Set flash message
                Yii::$app->getSession()->setFlash('success', 'Company created success');

                return $this->redirect(['company/index']);
            } else {
                // error in saving model

                Yii::$app->getSession()->setFlash('error', 'Oops! Something wrong');
            }
        }

		return $this->render('create', ['model' => $model]);
	}

	public function actionUpdate($id)
	{

	}
}