<?php

namespace backend\models;


use common\models\Site;
use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class SiteTextForm extends Model
{
    public $footer_text_model = NULL;
    public $contact_text_model = NULL;
    public $contact_feedback_model = NULL;
       
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
        
        [['footer_text_model'],'string', 'max' => 250],
        [['contact_text_model'], 'string', 'max' => 250],
        [['contact_feedback_model'], 'string', 'max' => 250],
        ];
    }
    public function attributeLabels()
    {
        return [
            'footer_text_model' => 'Footer Text',
            'contact_text_model' => 'Contact Text',
            'contact_feedback_model' => 'Contact Feedback',
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
            return true;
        }
    }
}
