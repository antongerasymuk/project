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
$this->title = 'Create payment method';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin([
    'id' => 'payment-form',
    'action' => \yii\helpers\Url::to(['payment/create', 'isAjax' => false]),
    'options' => ['enctype' => 'multipart/form-data']
]); ?>
<?= $form->field($model, 'title')->textInput() ?>
<?= $form->field($model, 'logoFile')->fileInput() ?>
<div class="form-group">
    <?= Html::submitButton('Create', ['class' => 'btn btn-primary', 'name' => 'payment-button']) ?>
</div>

<?php ActiveForm::end(); ?>
