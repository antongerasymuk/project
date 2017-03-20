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
use common\models\SiteNumber;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\UploadedFile;
use common\helpers\ImageNameHelper;

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
            $model->logoSmallFile = UploadedFile::getInstance($model, 'logoSmallFile');
            

            if (($model->logoFile)||($model->logoSmallFile)) {
                $path = '';
                $pathSmall = '';

                if ($model->logoFile) {
                    $basePath = ImageNameHelper::getImageName($model->logoFile);
                    //$basePath = $model->logoFile->baseName . time() . '.' . $model->logoFile->extension;

                    $path = Url::to(Yii::$app->params['uploadPath']) . $basePath;

                    // store the source file name
                    $model->logoFile->saveAs($path, false);
                }

                if ($model->logoSmallFile) {
                    $basePathSmall = ImageNameHelper::getImageName($model->logoSmallFile);
                    //$basePathSmall = $model->logoSmallFile->baseName . time() . '.' . $model->logoSmallFile->extension;
                    
                    $pathSmall = Url::to(Yii::$app->params['uploadPath']) . $basePathSmall;

                    // store the source file name
                    $model->logoSmallFile->saveAs($pathSmall, false);
                }

                //$path = Url::to(Yii::$app->params['uploadPath']) . $model->logoFile->baseName . time() . '.' . $model->logoFile->extension;
                //$pathSmall = Url::to(Yii::$app->params['uploadPath']) . $model->logoSmallFile->baseName . '.' . $model->logoSmallFile->extension;

                //store the source file name
                //$model->logoFile->saveAs($path, false);
                //$model->logoSmallFile->saveAs($pathSmall, false);

                if (is_file($path)||is_file($pathSmall)) {
                    if (is_file($path)) {
                        $model->logo = Yii::$app->params['uploadUrl'] . $basePath;
                    }

                    if(is_file($pathSmall)) {
                        $model->logo_small = Yii::$app->params['uploadUrl'] . $basePathSmall;
                    }
                } else {
                    $model->addError('logoFile', 'File url loading  to DB error!');
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

                    if ($this->setNumberOfActiveCompanies()) {
                        // Set flash message
                        Yii::$app->getSession()->setFlash('success', 'Company created success');
                    } else {
                        Yii::$app->getSession()->setFlash('error', 'Count of active companies not saved!');
                    }


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
            $model->logoSmallFile = UploadedFile::getInstance($model, 'logoSmallFile');

            if (($model->logoFile)||($model->logoSmallFile)) {
                $path = '';
                $pathSmall = '';

                if ($model->logoFile) {
                    
                    $basePath = ImageNameHelper::getImageName($model->logoFile);
                    //$basePath = $model->logoFile->baseName . time() . '.' . $model->logoFile->extension;
                    $path = Url::to(Yii::$app->params['uploadPath']) .$basePath;

                    // store the source file name
                    $model->logoFile->saveAs($path, false);
                }

                if ($model->logoSmallFile) {
                    
                    $basePathSmall = ImageNameHelper::getImageName($model->logoSmallFile);
                    //$basePathSmall = $model->logoSmallFile->baseName . time() . '.' . $model->logoSmallFile->extension;
                    $pathSmall = Url::to(Yii::$app->params['uploadPath']) . $basePathSmall;

                    // store the source file name
                    $model->logoSmallFile->saveAs($pathSmall, false);
                }

                // remove old logo_small file
                if (is_file(Url::to('@frontend/web') . $model->logo_small) && is_file($pathSmall)) {
                    unlink(Url::to('@frontend/web') . $model->logo_small);
                }

                // remove old logo file
                if (is_file(Url::to('@frontend/web') . $model->logo) && is_file($path)) {
                    unlink(Url::to('@frontend/web') . $model->logo);
                }

                if (is_file($path)||is_file($pathSmall)) {

                    if (is_file($path)) {
                        $model->logo = Yii::$app->params['uploadUrl'].$basePath;
                    }

                    if(is_file($pathSmall)) {
                        $model->logo_small = Yii::$app->params['uploadUrl'].$basePathSmall;
                    }
                } else {
                    $model->addError('logoFile', 'File url loading  to DB error!');
                }

                /*
                    if (is_file($pathSmall)) {
                        $model->logo_small = Yii::$app->params['uploadUrl'] . $model->logoSmallFile->baseName . time() .'.' . $model->logoSmallFile->extension;
                    } else {
                        $model->addError('logoFile', 'File loading error!');
                    }
                */


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

                if ($this->setNumberOfActiveCompanies()) {
                    // Set flash message
                    Yii::$app->getSession()->setFlash('success', 'Company updated success');
                } else {
                    Yii::$app->getSession()->setFlash('error', 'Count of active companies not saved!');
                }

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

    private function setNumberOfActiveCompanies()
    {
        //count  number of active companies
        $data = Company::find()->with(['reviews'])->asArray()->all();
        foreach ($data as $key => $row) {
            if (!count($row['reviews'])) {
                unset($data[$key]);
            }
        }

        $count = SiteNumber::find()->where(['type' => 1])->one();
        $count->value = (string)count($data);
        $count->save();

        if ($count->save()) {
            return true;
        }
        return false;
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

        $this->setNumberOfActiveCompanies();
        if ($this->setNumberOfActiveCompanies()) {
            // Set flash message
            Yii::$app->getSession()->setFlash('success', 'success of deleting company'.$model->title);
        } else {
            Yii::$app->getSession()->setFlash('error', 'count of active companies not saved');
        }

        return $this->redirect(['company/index']);
    }
}