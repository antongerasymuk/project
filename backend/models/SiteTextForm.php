<?php

namespace backend\models;

use common\models\Site;
use common\models\MetaTag;
use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class SiteTextForm extends Model
{
    const TITLE_TAG_TYPE = 1;
    const DESCRIPTION_TAG_TYPE = 2;
    const KEYWORDS_TAG_TYPE = 3;

    public $footer_text_model = NULL;

    public $contact_title_model = NULL;
    public $contact_subtitle_model = NULL;
    public $contact_text_model = NULL;
    public $contact_feedback_model = NULL;

    public $main_title_model = NULL;
    public $main_subtitle_model = NULL;
    public $main_list_title_model = NULL;
    public $main_text_model = NULL;

    public $sitemap_title_model = NULL;

    public $meta_title = NULL;
    public $meta_description = NULL;
    public $meta_keywords = NULL;
       

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
        
        [['footer_text_model'],'string'],

        [['contact_title_model'],'string'],
        [['contact_subtitle_model'],'string'],
        [['contact_text_model'], 'string'],
        [['contact_feedback_model'], 'string'],

        [['main_title_model'],'string'],
        [['main_subtitle_model'], 'string'],
        [['main_list_title_model'], 'string'],
        [['main_text_model'], 'string'],

        [['sitemap_title_model'], 'string'],

        [['meta_title', 'meta_description', 'meta_keywords'], 'safe']
        ];
    }
    public function attributeLabels()
    {
        return [
            'footer_text_model' => 'Footer Text',
            'contact_text_model' => 'Contact Text',
            'contact_feedback_model' => 'Contact Feedback',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords'

        ];
    }

    public function get() {

        $footerTextModel = Site::find()->where(['slug' => '-', 'title' => '-', 'category' => 'footer_text'])->one();

        $contactTextModel = Site::find()->where(['slug' => '-', 'title' => '-', 'category' => 'contact_text'])->one();
        $contactFeedbackModel = Site::find()->where(['slug' => '-', 'title' => '-', 'category' => 'contact_feedback'])->one();
        $contactTitleModel = Site::find()->where(['slug' => '-', 'title' => '-', 'category' => 'contact_title'])->one();
        $contactSubtitleModel = Site::find()->where(['slug' => '-', 'title' => '-', 'category' => 'contact_subtitle'])->one();

        $mainTitleModel = Site::find()->where(['slug' => '-', 'title' => '-', 'category' => 'main_title'])->one();
        $mainSubtitleModel = Site::find()->where(['slug' => '-', 'title' => '-', 'category' => 'main_subtitle'])->one();
        $mainListTitleModel = Site::find()->where(['slug' => '-', 'title' => '-', 'category' => 'main_list_title'])->one();
        $mainTextModel = Site::find()->where(['slug' => '-', 'title' => '-', 'category' => 'main_text'])->one();

        $sitemapTitleModel = Site::find()->where(['slug' => '-', 'title' => '-', 'category' => 'sitemap_title'])->one();


        if ($footerTextModel) {
            $this->footer_text_model = $footerTextModel->content; 
        } 
        
        if ($contactTextModel) {
            $this->contact_text_model = $contactTextModel->content;
        }
        
        if ($contactFeedbackModel) {
            $this->contact_feedback_model = $contactFeedbackModel->content;
        }

        if ($contactTitleModel) {
            $this->contact_title_model = $contactTitleModel->content;
        }

        if ($contactSubtitleModel) {
            $this->contact_subtitle_model = $contactSubtitleModel->content;
        }

        if ($mainTitleModel) {
            $this->main_title_model = $mainTitleModel->content;
        }

        if ($mainSubtitleModel) {
            $this->main_subtitle_model = $mainSubtitleModel->content;
        }

        if ($mainListTitleModel) {
            $this->main_list_title_model = $mainListTitleModel->content;
        }

        if ($mainTextModel) {
            $this->main_text_model = $mainTextModel->content;
        }

        if ($sitemapTitleModel) {
            $this->sitemap_title_model = $sitemapTitleModel->content;
        }

    } 

    public function getMetaTags()
    {
        $metaTags = MetaTag::find()->where(['review_id' => 0, 'category_id' => 0])->all();

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

    public function save()
    {
        $footerTextModel = Site::find()->where(['slug' => '-', 'title' => '-', 'category' => 'footer_text'])->one();
        $contactTextModel = Site::find()->where(['slug' => '-', 'title' => '-', 'category' => 'contact_text'])->one();
        $contactFeedbackModel = Site::find()->where(['slug' => '-', 'title' => '-', 'category' => 'contact_feedback'])->one();
        $contactTitleModel = Site::find()->where(['slug' => '-', 'title' => '-', 'category' => 'contact_title'])->one();
        $contactSubtitleModel = Site::find()->where(['slug' => '-', 'title' => '-', 'category' => 'contact_subtitle'])->one();
        $mainTitleModel = Site::find()->where(['slug' => '-', 'title' => '-', 'category' => 'main_title'])->one();
        $mainSubtitleModel = Site::find()->where(['slug' => '-', 'title' => '-', 'category' => 'main_subtitle'])->one();
        $mainListTitleModel = Site::find()->where(['slug' => '-', 'title' => '-', 'category' => 'main_list_title'])->one();
        $mainTextModel = Site::find()->where(['slug' => '-', 'title' => '-', 'category' => 'main_text'])->one();
        $sitemapTitleModel = Site::find()->where(['slug' => '-', 'title' => '-', 'category' => 'sitemap_title'])->one();

        if ($this->footer_text_model) {
            $footerTextModel->content = $this->footer_text_model; 
        } 
        
        if ($this->contact_text_model) {
           $contactTextModel->content = $this->contact_text_model;
        }
        
        if ($this->contact_feedback_model) {
            $contactFeedbackModel->content = $this->contact_feedback_model;
        }

        if ($this->contact_title_model) {
            $contactTitleModel->content = $this->contact_title_model;
        }

        if ($this->contact_subtitle_model) {
            $contactSubtitleModel->content = $this->contact_subtitle_model;
        }

        if ($this->main_title_model) {
            $mainTitleModel->content = $this->main_title_model;
        }

        if ($this->main_subtitle_model) {
            $mainSubtitleModel->content = $this->main_subtitle_model;
        }

        if ($this->main_list_title_model) {
            $mainListTitleModel->content = $this->main_list_title_model;
        }

        if ($this->main_text_model) {
            $mainTextModel->content = $this->main_text_model;
        }

        if ($this->sitemap_title_model) {
            $sitemapTitleModel->content = $this->sitemap_title_model;
        }

        if ($footerTextModel->save() && $contactTextModel->save() && $contactFeedbackModel->save() && $contactTitleModel->save() && $contactSubtitleModel->save() && $mainTitleModel->save() && $mainSubtitleModel->save() && $mainListTitleModel->save() && $mainTextModel->save() && $sitemapTitleModel->save()) {
           $metaTags = MetaTag::find()->where(['category_id' => 0,'review_id' => 0])->all();
        
        foreach ($metaTags as $key => $metaTag) {
            if (!empty($this->meta_title)&&($metaTag->type == self::TITLE_TAG_TYPE)) {
                $metaTag->value = $this->meta_title;

                if (!($metaTag->save())) {
                    return false;
                }
                
                continue;
            }

            if (!empty($this->meta_description)&&($metaTag->type == self::DESCRIPTION_TAG_TYPE)) {
                $metaTag->value  = $this->meta_description;
                if (!($metaTag->save())) {
                    return false;
                }
                
                continue;
            }

            if (!empty($this->meta_keywords)&&($metaTag->type == self::KEYWORDS_TAG_TYPE)) {
                $metaTag->value = $this->meta_keywords;
                if (!($metaTag->save())) {
                    return false;
                }
                
                continue;
            } 
        } 

        return true;
        } else {
            return false;
        } 

    }
     
}
