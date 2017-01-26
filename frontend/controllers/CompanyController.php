<?php
namespace frontend\controllers;

use common\models\Bonus;
//use Yii;

use common\models\Review;
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

    public function actionIndex($offset = 0, $limit = NULL)
    {
        $modelClass = $this->modelClass;
        
        if (!$limit) {
            $limit = $modelClass::find()->count();
        }

        $dependency = new \yii\caching\DbDependency(['sql' => 'SELECT COUNT(*) FROM companies']);

       // $data = $modelClass::getDb()->cache(function($db) 
       //     return $modelClass::find()
       //         ->with(['reviews.category', 'reviews.bonuses'])
       //         ->asArray()
       //         ->all();
       // }, 0, $dependency);

  
          $data = $modelClass::find()
                ->with(['reviews.category' , 'reviews.bonuses'])
                ->asArray()
                ->limit($limit)
                ->offset($offset)
                ->all();

        return $data;
    }
}
