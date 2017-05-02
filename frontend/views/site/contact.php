<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use common\helpers\SiteText;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">
	<div class="col-sm-6">
							<div class="contact-form">

                <?php $form = ActiveForm::begin(['fieldConfig' => [
                'options' => [
                    'tag' => false,
                ]
            ]]);  ?>
                <div class="grp">

                    <?= $form->field($model, 'name')->textInput(['autofocus' => true])->label('Full name'); ?>
                 </div>
                <div class="grp">
                    <?= $form->field($model, 'email')->label('Email'); ?>
                </div>
                <div class="grp">
                    <?= $form->field($model, 'message')->textArea(['rows' => 6]) ?>
                </div>

                    <div class="btn">
                        <?= Html::submitButton('Submit', [ 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

					<!-- .contact-form -->

						<div class="col-sm-6">
							<div class="contact-info">
								<h3><?= SiteText::get('contact_text'); ?></h3>

								<div class="eml">
									<i class="flaticon-email" style="float:left;"></i>
                                    <?= SiteText::get('contact_feedback'); ?>
								</div>

							</div>
						</div>

					</div>
