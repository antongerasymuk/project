<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $message;
   
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
        [['name', 'email', 'message',], 'required' ,'message'=>''],
            // email has to be a valid email address
        ['email', 'email'],
            // verifyCode needs to be entered correctly
        [['name'],'string', 'max' => 50],
        [['email'], 'string', 'max' => 50],
        [['message'], 'string', 'max' => 255],

        ];
    }

    /**
     * @return array customized attribute labels
     */
 
    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return boolean whether the model passes validation
     */
    public function contact($email)
    {
        if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom($this->email)
                ->setSubject("customer name:".$this->name)
                ->setTextBody($this->message)
                ->send();

            return true;
        }
        return false;
    }
}
