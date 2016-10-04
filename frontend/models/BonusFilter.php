<?php
namespace frontend\models;

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



    public $sort_by;
    public $bonus_type;
    public $payment_method;
    public $country;
    public $platform;

    public function filtered()
    {
        // hire return search results
    }
}