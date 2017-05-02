<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sites".
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property string $category
 */
class Site extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sites';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'slug'], 'required'],
            [['content'], 'required'],
            [['title', 'slug'], 'string', 'max' => 50],
            [['category'], 'default', 'value' => 'footer'],
            [['category'], 'string', 'max' => 20 ],
            [['content'], 'string'],
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
            'slug' => 'Slug',
            'content' => 'Content',
            'category' => 'Category',
        ];
    }

    public static function getForOther()
    {
        // cached
        $sites = Site::find()->where(['<>','title','-'])->andWhere(['<>','slug','-'])->all();
        //$sites = Site::getDb()->cache(function ($db){
        //    return Site::find()->all();
        //});
      
        $items = [];
        foreach ($sites as $site) {
            $items[$site->category][] = [
                'label' => $site->title,
                'url' =>  $site->slug
            ];
        }
        return $items;
    }
}
