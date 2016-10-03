<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */


class Contact extends \yii\db\ActiveRecord
{
    

    public static function tablename() {
        return 'contact';
    }
    /**
     * @inheritdoc
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
   
}
