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
            }, 'oses'])
            ->orderBy('')
            ->asArray();

        $data = new ActiveDataProvider([
            'query' => $bonuses
        ]);

        return $this->setRank(array_chunk($this->sort($data), 5));
    }

    /**
     * @param $data ActiveDataProvider
     */
    protected function sort($data)
    {
        $data = $data->query->all();
        $data[0]['reviews'][0]['ratings'][0]['rating'] = 5.000;

        $length = count($data);

        for ($j = 0; $j < $length - 1; $j++){
            for ($i = 0; $i < $length - $j - 1; $i++){
                if (empty($data[$i]['reviews'][0]['ratings'][0]['rating'])) {
                    continue;
                }

                // если текущий элемент больше следующего
                if ($data[$i]['reviews'][0]['ratings'][0]['rating'] < $data[$i + 1]['reviews'][0]['ratings'][0]['rating']){
                    // меняем местами элементы
                    $tmp_var = $data[$i + 1];
                    $data[$i + 1] = $data[$i];
                    $data[$i] = $tmp_var;
                }
            }
        }

        return $data;
    }

    /**
     * data is array div on 5 parts
     * @param array $data
     */
    protected function setRank(array $data)
    {
        $dataLength = count($data);

        // length = 5 parts;
        for ($i = 0; $i < $dataLength; $i++) {
            $bonusesLength = count($data[$i]);

            for ($j = 0; $j < $bonusesLength; $j++) {
                // set rank
                $data[$i][$j]['rank'] = $i + 1;
            }
        }

        return $data;
    }
}