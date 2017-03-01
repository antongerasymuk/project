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
    const TITLE_TAG_TYPE = 1;
    const DESCRIPTION_TAG_TYPE = 2;
    const KEYWORDS_TAG_TYPE = 3;

    public $meta_title;
    public $meta_description;
    public $meta_keywords;

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

            [['meta_title', 'meta_description', 'meta_keywords'], 'safe'],

            [['main_text'], 'string'],
            [['notes'], 'string'],
            [['list_title'], 'string'],

            [['no_deposit_main_text'], 'string'],
            [['no_deposit_notes'], 'string'],
            [['no_deposit_list_title'], 'string'],

            [['code_main_text'], 'string'],
            [['code_notes'], 'string'],
            [['code_list_title'], 'string'],
        ];
    }



    public function save($runValidation = true, $attributeNames = null)
    {
      
        $metaTags = MetaTag::find()->where(['category_id' => $this->id])->all();
           
        foreach ($metaTags as $key => $metaTag) {
            if (!empty($this->meta_title)&&($metaTag->type == self::TITLE_TAG_TYPE)) {
                $metaTag->value = $this->meta_title;

                if (!($metaTag->save())) {
                    return false;
                }
                $this->meta_title = null;
                continue;
            }

            if (!empty($this->meta_description)&&($metaTag->type == self::DESCRIPTION_TAG_TYPE)) {
                $metaTag->value  = $this->meta_description;
                if (!($metaTag->save())) {
                    return false;
                }
                $this->meta_description = null;
                continue;
            }

            if (!empty($this->meta_keywords)&&($metaTag->type == self::KEYWORDS_TAG_TYPE)) {
                $metaTag->value = $this->meta_keywords;
                if (!($metaTag->save())) {
                    return false;
                }
                $this->meta_keywords = null;
                continue;
            } 
        } 

        if ($this->meta_title) {
            $metaTag = new MetaTag;
            
            $metaTag->setAttributes(['value' => $this->meta_title , 'type' => self::TITLE_TAG_TYPE, 'category_id' => $this->id]);
          
            if (!($metaTag->save())) {
                return false;
            }
        }
        if ($this->meta_description) {
            $metaTag = new MetaTag;
            $metaTag->setAttributes(['value' => $this->meta_description , 'type' => self::DESCRIPTION_TAG_TYPE, 'category_id' => $this->id]);
        
            if (!($metaTag->save())) {
                return false;
            }
        }
        if ($this->meta_keywords) {
            $metaTag = new MetaTag;
            $metaTag->setAttributes(['value' => $this->meta_keywords , 'type' => self::KEYWORDS_TAG_TYPE, 'category_id' => $this->id]);
           
            if (!($metaTag->save())) {
                return false;
            }
        }

              
        return parent::save($runValidation,$attributeNames);
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
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords'
        ];
    }

     public function getMetaTags()
    {
        $metaTags = MetaTag::find()->where(['category_id' => $this->id])->all();

        foreach ($metaTags as $key => $metaTag) {
            
            if ($metaTag->type == self::TITLE_TAG_TYPE) {
               $this->meta_title = $metaTag->value;
            }
            if ($metaTag->type == self::DESCRIPTION_TAG_TYPE) {
               $this->meta_description = $metaTag->value;
            }
            if ($metaTag->type == self::KEYWORDS_TAG_TYPE) {
               $this->meta_keywords = $metaTag->value;
            }

        }

        return  $metaTags;
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
