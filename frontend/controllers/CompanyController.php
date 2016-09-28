<?php
namespace frontend\controllers;

use common\models\Bonus;
use common\models\Company;
//use Yii;

use yii\data\ActiveDataProvider;
use Yii;
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
            'index' => ['GET', 'HEAD'],];

    }

    public function actions()
    {
        return [
        ];
    }

    public function actionIndex()
    {
/*

    //    $companies = Company::find()->with('reviews')->asArray()->all();
        $companies = Company::find()
            ->with(['reviews.category', 'reviews.bonuses' => function($query){
                $query->andWhere(['type' => Bonus::MAIN]);
            }])
            ->asArray()
            ->all();


        return $companies;*/

        $modelClass = $this->modelClass;

        return new ActiveDataProvider([
            'query' => $modelClass::find()
                ->with(['reviews.category', 'reviews.bonuses' => function($query){
                    $query->andWhere(['type' => Bonus::MAIN]);
                }])
                ->asArray()
        ]);

    }
}
