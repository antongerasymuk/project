<?php
namespace frontend\controllers;

use common\models\Company;
//use Yii;
use yii\rest\ActiveController;

class CompanyController extends ActiveController
{
    public $modelClass = 'common\models\Company';

    public function checkAccess($action, $model = null, $params = [])
    {
        return true;
    }

    public function verbs()
    {
        return [
            'index' => ['GET', 'HEAD'],
            'view' => ['GET', 'HEAD'],
            'create' => ['POST'],
            'update' => ['PUT', 'PATCH'],
            'delete' => ['DELETE'],
        ];
    }

    public function actions()
    {
        return [
        ];
    }

    public function actionIndex()
    {
        $companies = Company::find()->with('reviews')->asArray()->all();
        return $companies;
    }
}
