<?php
namespace backend\controllers;

use common\models\Bonus;
use common\models\Bonuse;
use common\models\Company;
use common\models\DepositMethod;
use common\models\Director;
use common\models\Minuse;
use common\models\Pros;
use common\models\Rating;
use common\models\Review;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
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
        $review = new Review();

        if ($model->load(Yii::$app->request->post())) {
            // get the uploaded file instance. for multiple file uploads
            // the following data will return an array
            $logoFile = UploadedFile::getInstance($model, 'logoFile');

            if ($logoFile) {
                $path = Url::to(Yii::$app->params['uploadPath']) . $logoFile->baseName . '.' . $logoFile->extension;

                // store the source file name
                $model->logo = Yii::$app->params['uploadUrl'] . $logoFile->baseName . '.' . $logoFile->extension;

                if($model->save()){
                    $logoFile->saveAs($path);

                    //safe related reviews
                    foreach ($model->reviewIds as $id) {
                        $model->link('reviews', Review::findOne(['id' => $id]));
                    }
                    // Set flash message
                    Yii::$app->getSession()->setFlash('success', 'Company created success');

                    return $this->redirect(['company/index']);
                } else {
                    // error in saving model

                    Yii::$app->getSession()->setFlash('error', 'Oops! Something wrong');
                }
            } else {
                $model->addError('logoFile', 'Logo file not choosed');
            }
        }

        $reviewsData = Review::find()
            ->select('id, title')
            ->asArray()
            ->all();
        $reviewsData = ArrayHelper::map($reviewsData, 'id', 'title');

        $directorsData = Director::find()
            ->select('id, title')
            ->asArray()
            ->all();

        $directorsData = ArrayHelper::map($directorsData, 'id', 'title');

		return $this->render('create', [
		    'model' => $model,
            'review' => $review,
            'bonus' => new Bonus(),
            'rating' => new Rating(),
            'plus' => new Pros(),
            'director' => new Director(),
            'minus' => new Minuse(),
            'deposit' => new DepositMethod(),
            'reviewsData' => $reviewsData,
            'directorsData' => $directorsData
        ]);
	}

	public function actionEdit($id)
	{

	}
}