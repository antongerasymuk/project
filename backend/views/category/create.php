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
$this->title = 'Create company';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin(['id' => 'category-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>
<?= $form->field($model, 'title')->textInput() ?>
<div class="form-group">
    <?= Html::submitButton('Create', ['class' => 'btn btn-primary', 'name' => 'category-button']) ?>
</div>

<?php ActiveForm::end(); ?>
