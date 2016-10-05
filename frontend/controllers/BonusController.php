<?php
namespace frontend\controllers;

use common\models\Bonus;
use common\models\Review;
use frontend\models\BonusFilter;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use Yii;
use yii\rest\ActiveController;

class BonusController extends ActiveController
{
    public $modelClass = 'common\models\Review';

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
            if (!empty($arr[$i]['ratings'])) {
                $count = count($arr[$i]['ratings']);

                foreach ($arr[$i]['ratings'] as $rating) {
                    $sum += $rating['mark'];
                }

                $arr[$i]['ratings'] = $sum / $count;
                $sum = $count = 0;
            } else {
                $arr[$i]['ratings'] = 0;
            }
        }

        return $arr;
    }

    public function actionIndex(
        $category_id = null,
        $sort_by = null,
        $filter_by = null,
        $country_id = null,
        $dep_method_id = null,
        $os_id = null
    )
    {
        $modelClass = $this->modelClass;

        if ($category_id == null) {
            $bonuses = $modelClass::find()
                ->with('bonuses')
                ->with('ratings')
                ->with('bonuses.oses')
                ->asArray();
        } else {
            $bonuses = $modelClass::find()
                ->where(['category_id' => $category_id])
                ->with('bonuses')
                ->with('ratings')
                ->with('bonuses.oses')
                ->andWhere(['type' => Review::REVIEW_TYPE])
                ->asArray();
        }
        $data = new ActiveDataProvider([
            'query' => $bonuses
        ]);

        $data = $data->query->all();

//        return $data;
        $data = $this->calcRating($data);

        usort($data, function($a, $b){
            if ($a['ratings'] < $b['ratings']) return 1;
            if ($a['ratings'] > $b['ratings']) return -1;

            return 0;
        });

        $bonuses = $this->normalize($this->sortRank($data));

        if ($sort_by != null) {
            //
        }
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

    protected function sortByPrice($bonuses)
    {
        usort($bonuses, function ($a, $b){
            if ($a['price'] < $b['price']) return 1;
            if ($a['price'] > $b['price']) return -1;

            return 0;
        });

        return $bonuses;
    }

    protected function sortRank($arr_ratings)
    {
        $r = 1;//ранк счетчик
        $length = count($arr_ratings);

        for ($i = 0; $i < $length; $i++) {
            $arr_ratings[$i]['rank'] = $r;

            if (isset($arr_ratings[$i+1])) {
                if ($arr_ratings[$i]['ratings'] > $arr_ratings[$i+1]['ratings'])
                    $r++;
            }
        }

        return $arr_ratings;
    }

    protected function normalize($arr)
    {
        $bonuses = [];

        foreach ($arr as $review) {
            foreach ($review['bonuses'] as $bonus) {
                $bonus['rank'] = $review['rank'];
                $bonus['rating'] = $review['ratings'];
                $bonus['review_id'] = $review['id'];
                $bonuses[] = $bonus;
            }
        }

        return $bonuses;
    }
}