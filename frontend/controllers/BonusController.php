<?php
namespace frontend\controllers;

use common\models\Review;
use Yii;
use common\models\SiteNumber;
use yii\rest\ActiveController;
use yii\web\Response;

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
        $category_id = 1,
        $sort_by = null,
        $filter_by = null,
        $country_id = null,
        $deposit_id = null,
        $os_id = null,
        $limit = 15,
        $offset = 0
    ) {

        $modelClass = $this->modelClass;
         $dependency = Yii::createObject([
        'class' => 'yii\caching\DbDependency',
        'sql' => 'SELECT (SELECT SUM(CRC32(CONCAT_WS("",id,title,description,logo,code,referal_url,type,min_deposit,expiry,rollover_requirement,  restrictions,review_id,percent,currency))) FROM bonuses) + (SELECT SUM(CRC32(CONCAT_WS("",review_id,rating_id))) FROM review_rating) + (SELECT SUM(CRC32(CONCAT_WS("",os_id, review_id))) FROM os_review) + (SELECT SUM(CRC32(CONCAT_WS("",country_id, review_id))) FROM allowed_country) + (SELECT SUM(CRC32(CONCAT_WS("",dep_id, review_id))) FROM review_dep_method)'
        ]);

        //$dependency = new \yii\caching\DbDependency('SELECT sum(crc32(concat(id,title,description,logo,code))) AS crc FROM bonuses');
        //var_dump($dependency);
        //exit;

        $bonuses = $modelClass::find()
            ->with([
                /*'bonuses' => function ($query) use ($filter_by, $os_id) {
                    if (is_integer($filter_by)) {
                        switch ($filter_by) {
                            case 0:
                                $query->andWhere(['min_deposit' => null]);
                                break;
                            case 1 :
                                $query->andWhere(['not', ['min_deposit' => null]]);
                                break;
                            case 2 :
                                $query->andWhere(['not', ['code' => null]]);
                                break;
                        }
                    }

                },*/
                'bonuses' => function ($query) use ($filter_by, $os_id) {

                    if (strlen($filter_by)) {

                        switch ($filter_by) {

                            case 0:
                                $query->andWhere(['check_no_dep' => 1]);
                                break;
                            case 1 :
                                $query->andWhere(['check_dep' => 1])->andWhere(['not', ['min_deposit' => null]]);
                                break;
                            case 2 :
                                $query->andWhere(['not', ['code' => '']]);
                                break;
                        }
                    }
                },
                'ratings',
                'oses'
            ])
            ->andWhere(['type' => Review::REVIEW_TYPE])

            ->with(['denied' => function( \yii\db\ActiveQuery $query) use ($country_id)  {
                      if ($country_id) {
                        $query->andWhere (['=','id', $country_id]);
                      }
                    }])
            ->with(['allowed' =>
                    function( \yii\db\ActiveQuery $query) use ($country_id)  {
                        if ($country_id) {
                            $query->andWhere (['=','id', $country_id]);
                        }
                    }])

            ->asArray();



        if ((int)$os_id) {
            $bonuses->innerJoinWith('oses')
                ->where(['oses.id' => $os_id]);
        }

        if ((int)$deposit_id) {
            $bonuses->innerJoinWith('deposits')
                ->andWhere(['deposit_methods.id' => $deposit_id]);
        }

       /* if ((int)$country_id) {
            $bonuses->innerJoinWith('denied')
               //;
               //->andWhere(['countries.id' => $country_id]);
            ->andWhere(['<>','countries.id', $country_id]);
        }*/

        /*if ((int)$country_id) {
            $bonuses->innerJoinWith('allowed')
                ->andWhere(['countries.id' => $country_id]);
        }*/

        //if ((int)$country_id) {
       //     $bonuses->innerJoinWith('denied')
        //        ->andWhere(['countries.id' => $country_id]);
        //}

        $bonuses->andWhere(['reviews.category_id' => $category_id]);

//        $data = $modelClass::getDb()->cache(function ($db) use ($bonuses) {
//        return $bonuses->all();
//        }, 0, $dependency);

        $data = $bonuses->all();

        $bonusesCache = Yii::$app->cache->get('bonuses_sort_by_'.(int)$sort_by);
        $bonusesCache = false;

        if ($bonusesCache === false) {
            $data = $this->calcRating($data);

            usort($data, function ($a, $b) {
                if ($a['ratings'] < $b['ratings']) {
                    return 1;
                }
                if ($a['ratings'] > $b['ratings']) {
                    return -1;
                }

                return 0;
            });


            foreach ($data as $key => $value) {
                if (count($value['bonuses']) == 2) {
                    foreach ($value['bonuses'] as $bonusKey => $bonus) {
                        if ($bonus['type'] != 1) {
                            unset($data[$key]['bonuses'][$bonusKey]);
                            break;
                        }
                    }
                }
                if ((int)$country_id) {
                    if ((!empty($value['allowed']))&&(!empty($value['denied']))) {
                        unset($data[$key]);
                    }

                    if ((empty($value['allowed']))&&(!empty($value['denied']))) {
                        unset($data[$key]);
                    }
                }
            }

            $orderData = [];

            foreach ($data as  $value) {
                $orderData[] = $value;
            }

           $bonuses = $this->normalize($this->sortRank($orderData));

           if ((int)$sort_by) {
                switch ($sort_by) {
                    // Sort by top bonus %
                    case 2 :
                        $bonuses = $this->sortByPercent($bonuses);
                        break;
                    // Sort by max bonus
                    case 3 :
                        $bonuses = $this->sortByPrice($bonuses);
                        break;
                }
            }

        // cached sorted bonuses

        //Yii::$app->cache->set('bonuses_sort_by_'.(int)$sort_by, $bonuses, 0, $dependency);

        } else {
            $bonuses = $bonusesCache;
        }

       

        return array_slice($bonuses, (int)$offset, (int)$limit);
    }

    /**
     * data is array div on 5 parts of bonuses
     * @param array $data
     */
    protected function setRank(array $data)
    {
        $dataLength = count($data);

        for ($i = 0; $i < $dataLength; $i++) {
            //$data[$i]['rank'] = $i + 1;
        }

        return $data;
    }

    protected function sortByPercent($bonuses)
    {
        usort($bonuses, function ($a, $b) {
            if ($a['percent'] < $b['percent']) {
                return 1;
            }
            if ($a['percent'] > $b['percent']) {
                return -1;
            }

            return 0;
        });

        return $bonuses;
    }

    protected function sortByPrice($bonuses)
    {
        usort($bonuses, function ($a, $b) {
            if ($a['price'] < $b['price']) {
                return 1;
            }
            if ($a['price'] > $b['price']) {
                return -1;
            }

            return 0;
        });

        return $bonuses;
    }

    public function actionNumber($mode)
    {
        \Yii::$app->response->format = Response::FORMAT_RAW;
        $number = SiteNumber::find()->where(['type' => 0])->one();

        if ($mode == 'check') {
            $number->value = (string)($number->value + 1);
            $number->save();

        }

        if ($mode == 'get') {
            return $number->value;
        }
    }

    protected function sortRank($arr_ratings)
    {
        $r = 1;//ранк счетчик
        $length = count($arr_ratings);

        for ($i = 0; $i < $length; $i++) {
            if(!empty($arr_ratings[$i]['bonuses'])) {
            
            $arr_ratings[$i]['rank'] = $r++;

            } else {
               unset($arr_ratings[$i]);
            }
        }

        $arrOrderData = [];

        foreach ($arr_ratings as  $arr_rating) {
            $arrOrderData[] = $arr_rating;
        }


        return  $arrOrderData;
    }

    protected function normalize($arr)
    {

        $bonuses = [];

        foreach ($arr as $review) {

            foreach ($review['bonuses'] as $bonus) {
                $bonuses[] = $bonus + [
                        'rank' => $review['rank'],
                        'rating' => $review['ratings'],
                        'review_id' => $review['id'],
                        'oses' => $review['oses'],
                        'allowed' => $review['allowed'],
                        'denied' =>  $review['denied'],
                        'slug' => $review['slug'],
                    ];

            }
         }

        return $bonuses;
    }
}