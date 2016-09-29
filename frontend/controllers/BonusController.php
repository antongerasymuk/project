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

    protected function calcRating($arr)
    {
        $length = count($arr);
        $sum = $count = 0;

        for ($i = 0; $i < $length; $i++) {
//            $arr[$i]
            if (isset($arr[$i]['reviews'][0]['ratings'])) {
                $count = count($arr[$i]['reviews'][0]['ratings']);

                foreach ($arr[$i]['reviews'][0]['ratings'] as $rating) {
                    $sum += $rating['mark'];
                }

                $arr[$i]['reviews'][0]['ratings'] = $sum / $count;
                $arr[$i]['rating'] = $arr[$i]['reviews'][0]['ratings'];
                $sum = $count = 0;
            }
        }

        return $arr;
    }

    public function actionIndex()
    {
        $modelClass = $this->modelClass;

        $bonuses = $modelClass::find()
            ->with(['reviews' => function($query){
                $query->select('id');
            }, 'reviews.ratings' => function($query){
                $query->select(['id', 'mark']);
            }, 'oses'])
            ->asArray();

        $data = new ActiveDataProvider([
            'query' => $bonuses
        ]);

        $data = $data->query->all();
        $data = $this->calcRating($data);

        usort($data, function($a, $b){
            if ($a['reviews'][0]['ratings'] < $b['reviews'][0]['ratings']) return 1;
            if ($a['reviews'][0]['ratings'] > $b['reviews'][0]['ratings']) return -1;

            return 0;
        });

        return $this->sortRank($data);
    }

    /**
     * data is array div on 5 parts of bonuses
     * @param array $data
     */
    protected function setRank(array $data)
    {
        $dataLength = count($data);

        for ($i = 0; $i < $dataLength; $i++) {
            $data[$i]['rank'] = $i + 1;
        }

        return $data;
    }

    protected function sortRank($arr_ratings)
    {
        $arr_ranks = [];
        $r = 1;//ранк счетчик
        $length = count($arr_ratings);

        for ($i = 0; $i < $length; $i++) {
            $arr_ratings[$i]['rank'] = $r;

            if (isset($arr_ratings[$i+1])) {
                if ($arr_ratings[$i]['rating'] > $arr_ratings[$i+1]['rating'])
                    $r++;
            }
        }

        return $arr_ratings;
    }
}