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
<?= $form->field($model, 'logoFile')->fileInput()->label('Logo file') ?>

<?= $form->field($model, 'logoSmallFile')->fileInput()->label('Small logo file') ?>

<?= $form->field($model, 'site_url')->textInput()->label('Company site url') ?>
<?= $form->field($model, 'rel')->checkbox()->label('Put url rel nofollow') ?>
<?= $form->field($model, 'hide_ext_url')->checkbox() ?>
<div class="form-group-select">
<?= $form->field($model, 'director_id')->widget(Select2::classname(), [
    'data' => \common\helpers\ModelMapHelper::getIdTitleMap(\common\models\Director::className(), true),
    'options' => ['placeholder' => 'Select a state ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
])->label('Director');
?>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#director-create-modal">+</button></div>
<div class="form-group-select">
<?= $form->field($model, 'licenseIds')->widget(Select2::classname(), [
    'data' => \common\helpers\ModelMapHelper::getIdTitleMap(\common\models\License::className(), true),
    'options' => ['multiple' => true, 'placeholder' => 'Select a state ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
])->label('Licenses');
?>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#license-create-modal">+</button></div>
<div class="form-group-select">
<?= $form->field($model, 'reviewIds')->widget(Select2::classname(), [
    'data' => \common\helpers\ModelMapHelper::getIdTitleMap(\common\models\Review::className(), true),
    'options' => ['multiple' => true, 'placeholder' => 'Select a state ...'],
    'pluginOptions' => [
    'allowClear' => true
    ],
])->label('Reviews');
?>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#review-create-modal">+</button>
</div>
<div class="form-group">
    <?= Html::submitButton('Create', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
</div>
<?php ActiveForm::end(); ?>
<?= $this->render('//review/create_modal', ['model' => $review]) ?>
<?= $this->render('//bonus/create_modal', ['model' => $bonus]) ?>
<?= $this->render('//rating/create_modal', ['model' => $rating]) ?>
<?= $this->render('//plus/create_modal', ['model' => $plus]) ?>
<?= $this->render('//minus/create_modal', ['model' => $minus]) ?>
<?= $this->render('//payment/create_modal', ['model' => $deposit]) ?>
<?= $this->render('//director/create_modal', ['model' => $director]) ?>
<?= $this->render('//license/create_modal', ['model' => $license]) ?>
