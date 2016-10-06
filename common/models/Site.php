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
            [['title', 'slug'], 'string', 'max' => 50],
            [['content'], 'string', 'max' => 255],
            [['category'], 'string', 'max' => 20],
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
}