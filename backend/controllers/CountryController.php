<?php
namespace backend\controllers;

use common\models\Bonus;
use common\models\Bonuse;
use common\models\Company;
use common\models\Country;
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
class CountryController extends BackEndController
{
    public function actionIndex()
    {
        $countries = Country::find()->all();

        return $this->render('index', ['countries' => $countries]);
    }

    public function actionCreate()
    {
        $model = new Country();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', 'Country created success');

            return $this->redirect(['country/index']);
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionEdit($id)
    {
        $model = Country::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', 'Country updated success');

            return $this->redirect(['country/index']);
        }

        return $this->render('update', ['model' => $model]);
    }
    public function actionDelete($id)
    {
       $model = Country::findOne($id);
       $model->delete();
       $model->unlinkAll('reviewsAllowed',true);
       $model->unlinkAll('reviewsDenied',true);
 
       Yii::$app->getSession()->setFlash('success', 'success of deleting '.$model->title);
       return $this->redirect(['country/index']);
    }

}