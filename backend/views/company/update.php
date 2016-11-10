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
$this->title = 'Edit company';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>

<?= $form->field($model, 'title')
         ->textInput(['autofocus' => true])
         ->label('Name')
?>
<?= $form->field($model, 'rating')->textInput() ?>
<?= $form->field($model, 'bg_color')->widget(\dpodium\colorpicker\ColorPickerWidget::className(),
    ['id' => 'color-picker', 'name' => 'color-picker'])
         ->label('Background color')
?>
<img src="<?= $model->logo ?>">
<?= $form->field($model, 'logoFile')->fileInput()->label('Logo file') ?>
<?= $form->field($model, 'site_url')->textInput()->label('Company site url') ?>
<?= $form->field($model, 'director_id')->widget(Select2::classname(), [
    'data' => \common\helpers\ModelMapHelper::getIdTitleMap(\common\models\Director::className()),
    'language' => 'en_GB',
    'options' => ['placeholder' => 'Select a state ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
])->label('Director');
?>
<?= $form->field($model, 'licenseIds')->widget(Select2::classname(), [
    'data' => \common\helpers\ModelMapHelper::getIdTitleMap(\common\models\License::className()),
    'language' => 'en_GB',
    'options' => ['multiple' => true, 'placeholder' => 'Select a state ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
])->label('Licenses');
?>
<?= $form->field($model, 'reviewIds')->widget(Select2::classname(), [
    'data' => \common\helpers\ModelMapHelper::getIdTitleMap(\common\models\Review::className()),
    'language' => 'en_GB',
    'options' => ['multiple' => true, 'placeholder' => 'Select a state ...'],
    'pluginOptions' => [
        'allowClear' => true
    ]
])->label('Reviews');
?>
<div class="form-group">
    <?= Html::submitButton('Update', ['class' => 'btn btn-primary', 'name' => 'update-button']) ?>
</div>

<?php ActiveForm::end(); ?>
