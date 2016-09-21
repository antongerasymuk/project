<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>
<div class="row-fluid">
	<div class="login-box">
		<div class="icons">
			<a href="/"><i class="halflings-icon home"></i></a>
<!--			<a href="#"><i class="halflings-icon cog"></i></a>-->
		</div>
		<h2>Login to admin panel</h2>
		<?php $form = ActiveForm::begin([
			'id' => 'login-form',
			'options' => ['class' => 'form-horizontal'],
			'fieldConfig' => [
				'options' => [
					'tag' => false,
				],
			],
		]); ?>
			<fieldset>
				<div class="input-prepend form-group field-username required has-error" title="Username">
					<span class="add-on"><i class="halflings-icon user"></i></span>
					<?= $form->field($model, 'username')->textInput([
						'autofocus' => true,
						'id' => 'username',
						'class' => 'input-large span10',
						'placeholder' => 'type username'
					])->label(false) ?>
				</div>
				<div class="clearfix"></div>

				<div class="input-prepend form-group field-password required has-error" title="Password">
					<span class="add-on"><i class="halflings-icon lock"></i></span>
					<?= $form->field($model, 'password')->passwordInput([
						'id' => 'password',
						'class' => 'input-large span10',
						'placeholder' => 'type password'
					])->label(false) ?>
				</div>
				<div class="clearfix"></div>

				<label class="remember" for="remember">
					<div class="checker" id="uniform-remember">
						<span>
							<?= Html::activeCheckbox($model, 'rememberMe', ['label' => false]); ?>
						</span>
					</div>
					Remember me</label>

				<div class="button-login">
					<?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
				</div>
				<div class="clearfix"></div>

				<hr>
				<h3>Forgot Password?</h3>
				<p>
					No problem, <a href="#">click here</a> to get a new password.
				</p>
			</fieldset>
		<?php ActiveForm::end(); ?>
	</div><!--/span-->
</div>