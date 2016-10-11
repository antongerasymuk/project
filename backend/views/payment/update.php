<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use dosamigos\tinymce\TinyMce;
use yii\bootstrap\Modal;
use kartik\select2\Select2;

/**
 * @var $this \yii\web\View
 * @var $model \common\models\Company
 */
$this->title = 'Update payment method';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin(['id' => 'payment-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>
<?= $form->field($model, 'title')->textInput() ?>
<?php if (!empty($model->logo)) : ?>
    <div class="form-group">
        <img src="<?= $model->logo ?>" width="70" height="70">
    </div>
<?php endif; ?>
<?= $form->field($model, 'logoFile')->fileInput() ?>
<div class="form-group">
    <?= Html::submitButton('Update', ['class' => 'btn btn-primary', 'name' => 'payment-button']) ?>
</div>

<?php ActiveForm::end(); ?>
