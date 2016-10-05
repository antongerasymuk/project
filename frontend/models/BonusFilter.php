<?php
namespace frontend\models;

use common\models\Bonus;
use common\models\Review;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class BonusFilter extends ActiveRecord
{
    const SORT_BY = [
        1 => 'bestSite',
        2 => 'topBonus',
        3 => 'maxBonus'
    ];

    const FILTER_BY = [
        1 => 'depositBonus',
        2 => 'noDeposit',
        3 => 'bonusCodes'
    ];



    public $category_id;
    public $sort_by;
    public $filter_by;
//    public $country;

    public function filtered()
    {
        // hire return search results
        $bonusesQuery = Review::find()
                ->where(['category_id' => $this->category_id])
                ->with('bonuses')
                ->with('ratings')
                ->with('bonuses.oses');

        return $bonusesQuery->asArray()->all();
    }

    public function attributes()
    {
        return [
            [['category_id'], 'integer', 'min' => 1],
            [['sort_by'], 'integer', 'min' => 1],
            [['filter_by'], 'integer', 'min' => 0]
        ];
    }
}