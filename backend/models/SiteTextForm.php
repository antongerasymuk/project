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
    public $contact_text_model = NULL;
    public $contact_feedback_model = NULL;

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
        [['contact_text_model'], 'string'],
        [['contact_feedback_model'], 'string'],
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
       
        if ($footerTextModel) {
            $this->footer_text_model = $footerTextModel->content; 
        } 
        
        if ($contactTextModel) {
            $this->contact_text_model = $contactTextModel->content;
        }
        
        if ($contactFeedbackModel) {
            $this->contact_feedback_model = $contactFeedbackModel->content;
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

        if ($this->footer_text_model) {
            $footerTextModel->content = $this->footer_text_model; 
        } 
        
        if ($this->contact_text_model) {
           $contactTextModel->content = $this->contact_text_model;
        }
        
        if ($this->contact_feedback_model) {
            $contactFeedbackModel->content = $this->contact_feedback_model;
        }

        if ($footerTextModel->save() && $contactTextModel->save() && $contactFeedbackModel->save()) {
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
