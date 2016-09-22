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
		return $this->render('index');
	}

	public function actionCreate()
	{
        $model = new Company();

        if (Yii::$app->request->isPost) {
            $model->logo = UploadedFile::getInstance($model, 'logo');

            if ($model->logo && $model->save()) {
                $model->logo->saveAs(Url::to('@frontend/web/uploads/') . $model->logo->baseName . '.' . $model->logo->extension);
            }
        }

		return $this->render('create', ['model' => $model]);
	}

	public function actionUpdate($id)
	{

	}
}