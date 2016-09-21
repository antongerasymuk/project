<?php use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/**
 * @var $this \yii\web\View
 * @var $model \common\models\Company
 */
$this->title = 'Create company'; ?>

<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

<?= $form->field($model, 'title')
	->textInput(['autofocus' => true])
	->label('Name')
?>

<?= $form->field($model, 'description')->textarea() ?>

<div class="form-group">
	<?= Html::submitButton('Create', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
</div>

<?php ActiveForm::end(); ?>
