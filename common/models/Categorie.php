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

    public static function getArr()
    {
        $categoriesData = Categorie::getDb()->cache(function($db){
            return Categorie::find()
                     ->select('id, title')
                     ->asArray()
                     ->all();
        });

        $categoriesCache = Yii::$app->cache->get('categoriesCache');

        if ($categoriesCache === false) {
            $catArr = ArrayHelper::map($categoriesData, 'id', 'title');

            Yii::$app->cache->set('categoriesCache', $catArr);
        } else {
            $categoriesData = $categoriesCache;
        }

        return $categoriesData;
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
                'url' => ['site/category', 'id' => $category->id]
            ];
        }

        return $items;
    }
}
