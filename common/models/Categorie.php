<?php

namespace common\models;

use Yii;
use yii\caching\DbDependency;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
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
    
    const TITLE_TAG_TYPE_NO_DEPOSIT = 4;
    const DESCRIPTION_TAG_TYPE_NO_DEPOSIT = 5;
    const KEYWORDS_TAG_TYPE_NO_DEPOSIT = 6;

    const TITLE_TAG_TYPE_CODE = 7;
    const DESCRIPTION_TAG_TYPE_CODE = 8;
    const KEYWORDS_TAG_TYPE_CODE = 9;


    public $meta_title;
    public $meta_description;
    public $meta_keywords;

    public $meta_title_no_deposit;
    public $meta_description_no_deposit;
    public $meta_keywords_no_deposit;

    public $meta_title_code;
    public $meta_description_code;
    public $meta_keywords_code;

    

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
            [['title'], 'string', 'max' => 50],

            [['meta_title', 'meta_description', 'meta_keywords'], 'safe'],
            [['meta_title_no_deposit', 'meta_description_no_deposit', 'meta_keywords_no_deposit'], 'safe'],
            [['meta_title_code', 'meta_description_code', 'meta_keywords_code'], 'safe'],


            // [['meta_title', 'meta_description', 'meta_keywords'], 'match', 'pattern' => '/^[а-яА-ЯёЁa-zA-Z0-9_\s,.\%|$€£\/\\=\+&№\"\:\;\'-]+$/', 'message' => 'Your text string is incorrect!'],
           // [['meta_title_no_deposit', 'meta_description_no_deposit', 'meta_keywords_no_deposit'], 'match', 'pattern' => '/^[а-яА-ЯёЁa-zA-Z0-9_\s,.\%|$€£\/\\=\+&№\"\:\;\'-]+$/', 'message' => 'Your text string is incorrect!'],
           // [['meta_title_code', 'meta_description_code', 'meta_keywords_code'], 'match', 'pattern' => '/^[а-яА-ЯёЁa-zA-Z0-9_\s,.\%|$€£\/\\=\+&№\"\:\;\'-]+$/', 'message' => 'Your text string is incorrect!'],
            
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
        
        //save for update       
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

            if (!empty($this->meta_title_no_deposit)&&($metaTag->type == self::TITLE_TAG_TYPE_NO_DEPOSIT)) {
                $metaTag->value = $this->meta_title_no_deposit;
                if (!($metaTag->save())) {
                    return false;
                }
                $this->meta_title_no_deposit = null;
                continue;
            } 

            if (!empty($this->meta_description_no_deposit)&&($metaTag->type == self::DESCRIPTION_TAG_TYPE_NO_DEPOSIT)) {
                $metaTag->value = $this->meta_description_no_deposit;
                if (!($metaTag->save())) {
                    return false;
                }
                $this->meta_description_no_deposit = null;
                continue;
            } 

            if (!empty($this->meta_keywords_no_deposit)&&($metaTag->type == self::KEYWORDS_TAG_TYPE_NO_DEPOSIT)) {
                $metaTag->value = $this->meta_keywords_no_deposit;
                if (!($metaTag->save())) {
                    return false;
                }
                $this->meta_keywords_no_deposit = null;
                continue;
            } 

            if (!empty($this->meta_title_code)&&($metaTag->type == self::TITLE_TAG_TYPE_CODE)) {
                $metaTag->value = $this->meta_title_code;
                if (!($metaTag->save())) {
                    return false;
                }
                $this->meta_title_code = null;
                continue;
            } 

            if (!empty($this->meta_description_code)&&($metaTag->type == self::DESCRIPTION_TAG_TYPE_CODE)) {
                $metaTag->value = $this->meta_description_code;
                if (!($metaTag->save())) {
                    return false;
                }
                $this->meta_description_code = null;
                continue;
            } 

            if (!empty($this->meta_keywords_code)&&($metaTag->type == self::KEYWORDS_TAG_TYPE_CODE)) {
                $metaTag->value = $this->meta_keywords_code;
                if (!($metaTag->save())) {
                    return false;
                }
                $this->meta_keywords_code = null;
                continue;
            } 
        }

        // save for create 
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

        if ($this->meta_title_no_deposit) {
            $metaTag = new MetaTag;
            $metaTag->setAttributes(['value' => $this->meta_title_no_deposit , 'type' => self::TITLE_TAG_TYPE_NO_DEPOSIT, 'category_id' => $this->id]);
           
            if (!($metaTag->save())) {
                return false;
            }
        }

        if ($this->meta_description_no_deposit) {
            $metaTag = new MetaTag;
            $metaTag->setAttributes(['value' => $this->meta_description_no_deposit , 'type' => self::DESCRIPTION_TAG_TYPE_NO_DEPOSIT, 'category_id' => $this->id]);
           
            if (!($metaTag->save())) {
                return false;
            }
        }

        if ($this->meta_keywords_no_deposit) {
            $metaTag = new MetaTag;
            $metaTag->setAttributes(['value' => $this->meta_keywords_no_deposit , 'type' => self::KEYWORDS_TAG_TYPE_NO_DEPOSIT, 'category_id' => $this->id]);
           
            if (!($metaTag->save())) {
                return false;
            }
        }

        if ($this->meta_title_code) {
            $metaTag = new MetaTag;
            $metaTag->setAttributes(['value' => $this->meta_title_code , 'type' => self::TITLE_TAG_TYPE_CODE, 'category_id' => $this->id]);
           
            if (!($metaTag->save())) {
                return false;
            }
        }

        if ($this->meta_description_code) {
            $metaTag = new MetaTag;
            $metaTag->setAttributes(['value' => $this->meta_description_code , 'type' => self::DESCRIPTION_TAG_TYPE_CODE, 'category_id' => $this->id]);
           
            if (!($metaTag->save())) {
                return false;
            }
        }

        if ($this->meta_keywords_code) {
            $metaTag = new MetaTag;
            $metaTag->setAttributes(['value' => $this->meta_keywords_code , 'type' => self::KEYWORDS_TAG_TYPE_CODE, 'category_id' => $this->id]);
           
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
            'meta_keywords' => 'Meta Keywords',
            
            'meta_title_no_deposit' => 'Meta Title No Deposit',
            'meta_description_no_deposit' => 'Meta Description No Deposit',
            'meta_keywords_no_deposit' => 'Meta Keywords No Deposit',
            
            'meta_title_code' => 'Meta Title Code',
            'meta_description_code' => 'Meta Description Code',
            'meta_keywords_code' => 'Meta Keywords Code'
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

            if ($metaTag->type == self::TITLE_TAG_TYPE_NO_DEPOSIT) {
               $this->meta_title_no_deposit = $metaTag->value;
            }
            if ($metaTag->type == self::DESCRIPTION_TAG_TYPE_NO_DEPOSIT) {
               $this->meta_description_no_deposit = $metaTag->value;
            }
            if ($metaTag->type == self::KEYWORDS_TAG_TYPE_NO_DEPOSIT) {
               $this->meta_keywords_no_deposit = $metaTag->value;
            }
            
            if ($metaTag->type == self::TITLE_TAG_TYPE_CODE) {
               $this->meta_title_code = $metaTag->value;
            }
            if ($metaTag->type == self::DESCRIPTION_TAG_TYPE_CODE) {
               $this->meta_description_code = $metaTag->value;
            }
            if ($metaTag->type == self::KEYWORDS_TAG_TYPE_CODE) {
               $this->meta_keywords_code = $metaTag->value;
            }

        }

        return  $metaTags;
    }

    public static function getForNav()
    {

        $dependency = new DbDependency(['sql' => 'SELECT SUM(CRC32(CONCAT(id,pos,title))) FROM categories']);

        // cached
        $categories = Categorie::getDb()->cache(function ($db){
            return Categorie::find()->orderBy('pos')->all();
        }, 0, $dependency);

        $items = [];
		$current_url = Url::to('');
        foreach ($categories as $category) {
            $item = [
                'label' => $category->title,
                'url' => [mb_strtolower($category->title).'/']
                //'url' => ['site/category', 'id' => $category->id , 'filter_by' => 1, 'sort_by' =>1]
            ];
			if ('/'.mb_strtolower($category->title).'/' == $current_url) {
				$item['options'] = ['class' => 'active'];
			}
			$items[] = $item;
        }

        return $items;
    }
}
