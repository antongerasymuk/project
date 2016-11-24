<?php
namespace backend\controllers;

use common\models\Bonus;
use common\models\Bonuse;
use common\models\Company;
use common\models\DepositMethod;
use common\models\Director;
use common\models\License;
use common\models\Minuse;
use common\models\Plus;
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
	    $companies = Company::find()->all();

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
            $model->logoFile = UploadedFile::getInstance($model, 'logoFile');

            if ($model->logoFile) {
                $path = Url::to(Yii::$app->params['uploadPath']) . $model->logoFile->baseName . '.' . $model->logoFile->extension;

                // store the source file name
                $model->logoFile->saveAs($path);

                if (file_exists($path)) {
                    $model->logo = Yii::$app->params['uploadUrl'] . $model->logoFile->baseName . '.' . $model->logoFile->extension;
                }

                if($model->save()){
                    //$model->logoFile->saveAs($path);

                    if (!empty($model->reviewIds)) {
                        foreach ($model->reviewIds as $id) {
                            $review = Review::findOne($id);
                            $review->company_id = $model->id;
                            $review->update(true, ['company_id']);
                        }
                    }
                    // safe company licenses
                    if (!empty($model->licenseIds)) {
                        foreach ($model->licenseIds as $id) {
                            $model->link('licenses', License::findOne($id));
                        }
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

       	return $this->render('create', [
		    'model' => $model,
            'review' => $review,
            'bonus' => new Bonus(),
            'rating' => new Rating(),
            'plus' => new Plus(),
            'director' => new Director(),
            'minus' => new Minuse(),
            'deposit' => new DepositMethod(),
            'license' => new License(),
            
        ]);
	}

	public function actionEdit($id)
	{
        $model = Company::findOne(['id' => $id]);
        $model->scenario = 'edit';

        if ($model->load(Yii::$app->request->post())) {
            $model->logoFile = UploadedFile::getInstance($model, 'logoFile');

            if ($model->logoFile) {
                // remove old logo file
                if (file_exists(Url::to('@frontend/web') . $model->logo)) {
                    unlink(Url::to('@frontend/web') . $model->logo);
                }

                $path = Url::to(Yii::$app->params['uploadPath']) . $model->logoFile->baseName . '.' . $model->logoFile->extension;
                // store the source file name
                $model->logoFile->saveAs($path);
                if (file_exists($path)) {
                    $model->logo = Yii::$app->params['uploadUrl'] . $model->logoFile->baseName . '.' . $model->logoFile->extension;
                }
                //$model->logoFile->saveAs($path);
            }

            if ($model->save()) {
                $model->unlinkAll('licenses', true);
                $model->unlinkAll('reviews', false);

                if (!empty($model->reviewIds)) {
                    foreach ($model->reviewIds as $id) {
                        $review = Review::findOne($id);
                        $review->company_id = $model->id;
                        $review->update(true, ['company_id']);
                    }
                }

                if (!empty($model->licenseIds)) {
                    foreach ($model->licenseIds as $id) {
                        $model->link('licenses', License::findOne($id));
                    }
                }

                Yii::$app->getSession()->setFlash('success', 'Company updated success');

                return $this->redirect(['company/index']);
            }
        }

        $model->licenseIds = ArrayHelper::map($model->getLicenses()
            ->select('id, title')
            ->asArray()
            ->all(),
            'id', 'id'
        );

        $model->reviewIds = $model->getReviews()
                       ->select('id, title')
                       ->asArray()
                       ->all();
        $model->reviewIds = ArrayHelper::map($model->reviewIds, 'id', 'id');

	    return $this->render('update', [
            'model' => $model
        ]);
	}
    public function actionDelete($id)
    {
       $model = Company::findOne($id);
       $modelReview = Review::find()->where(['company_id' => $id])->all();
       $model->delete();
       $model->unlinkAll('licenses',true);
       foreach ($modelReview as $review) {
           $review->category_id = NULL;
           $review->save(false);
         
       } 
       
       Yii::$app->getSession()->setFlash('success', 'success of deleting '.$model->title);
       return $this->redirect(['category/index']);
    }
}