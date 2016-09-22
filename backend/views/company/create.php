<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use dosamigos\tinymce\TinyMce;
use kartik\color\ColorInput;

/**
 * @var $this \yii\web\View
 * @var $model \common\models\Company
 */
$this->title = 'Create company';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>

<?= $form->field($model, 'title')
         ->textInput(['autofocus' => true])
         ->label('Name')
?>
<?= $form->field($model, 'description')->widget(TinyMce::className(), [
    'options'       => ['rows' => 6],
    'language'      => 'es',
    'clientOptions' => [
        'plugins' => [
            "advlist autolink lists link charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    ]
])
?>
<?= $form->field($model, 'bg_color')->widget(\dpodium\colorpicker\ColorPickerWidget::className(),
    ['id' => 'color-picker', 'name' => 'color-picker'])
    ->label('Background color')
?>
<?= $form->field($model, 'logo')->fileInput()->label('Logo file') ?>
<?= $form->field($model, 'site_url')->textInput()->label('Company site url') ?>

<div class="form-group">
    <?= Html::submitButton('Create', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
</div>

<?php ActiveForm::end(); ?>
