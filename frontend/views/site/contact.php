<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">

						<div class="col-sm-6">
							<div class="contact-form">

								<div class="grp">
									<label>Full name</label>
									<input type="text" value="" />
								</div>

								<div class="grp">
									<label>Email</label>
									<input type="text" value="" />
								</div>

								<div class="grp">
									<label>Message</label>
									<textarea name=""></textarea>
								</div>

								<div class="btn">
									<button type="button">SUBMIT</button>
								</div>


							</div>
						</div><!-- .contact-form -->

						<div class="col-sm-6">
							<div class="contact-info">
								<h3>We love to receive feedback, suggestions and comments about the site.</h3>
								<div class="phn">
									<i class="flaticon-phone"></i>
									Phone: Call our UK office on <a href="tel: +44 (0) 0000 000-000">+44 (0) 0000 000-000</a>
								</div>

								<div class="eml">
									<i class="flaticon-email"></i>
									Email: Contact us via email at <a href="mailto:info@bonusonline.co.uk">info@bonusonline.co.uk</a> and we try to respond within 24 hours.
								</div>

							</div>
						</div>

					</div>
