<?php
namespace frontend\controllers;

use common\models\Bonus;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use Yii;
use yii\rest\ActiveController;

class BonusController extends ActiveController
{
    public $modelClass = 'common\models\Bonus';

    public function checkAccess($action, $model = null, $params = [])
    {
        return true;
    }

    public function verbs()
    {
        return [
            'index' => ['GET', 'HEAD'],
        ];
    }

    public function actions()
    {
        return [
        ];
    }

    public function actionIndex()
    {
        $modelClass = $this->modelClass;

        $bonuses = $modelClass::find()
            ->with(['reviews' => function($query){
                $query->select('id')->limit(1)->one();
            }, 'reviews.ratings' => function($query){
                $query->select('id, avg(mark) as rating');
            }])
            ->asArray();

        return new ActiveDataProvider([
            'query' => $bonuses
        ]);
    }
}