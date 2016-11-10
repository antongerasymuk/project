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
$this->title = 'Update category';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin(['id' => 'category-form']); ?>
<?= $form->field($model, 'title')->textInput() ?>
<?= $form->field($model, 'pos')->textInput()->label('Index Position') ?>
<div class="form-group">
    <?= Html::submitButton('Update', ['class' => 'btn btn-primary', 'name' => 'category-button']) ?>
</div>

<?php ActiveForm::end(); ?>
