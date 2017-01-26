<?php

namespace common\models;

use Yii;
use yii\caching\DbDependency;
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
            [['pos'], 'integer', 'max' => 10],
            [['title'], 'string', 'max' => 30],
            [['main_text'], 'string'],
            [['notes'], 'string'],
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
        $dependency = new DbDependency(['sql' => 'SELECT count(*) FROM categories']);
        // cached
        $categories = Categorie::getDb()->cache(function ($db){
            return Categorie::find()->orderBy('pos')->all();
        }, 0, $dependency);

        $items = [];

        foreach ($categories as $category) {
            $items[] = [
                'label' => $category->title,
                'url' => [mb_strtolower($category->title).'/']
                //'url' => ['site/category', 'id' => $category->id , 'filter_by' => 1, 'sort_by' =>1]
            ];
        }

        return $items;
    }
}
