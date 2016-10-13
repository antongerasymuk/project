<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "categories".
 *
 * @property integer $id
 * @property string $title
 * @property integer $company_id
 */
class Categorie extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'company_id' => 'Company ID',
        ];
    }

    public static function getForNav()
    {
        // cached
        $categories = Categorie::getDb()->cache(function ($db){
            return Categorie::find()->all();
        });

        $items = [];

        foreach ($categories as $category) {
            $items[] = [
                'label' => $category->title,
                'url' => ['site/category', 'id' => $category->id , 'filter_by' => 1, 'sort_by' =>1]
            ];
        }

        return $items;
    }
}
