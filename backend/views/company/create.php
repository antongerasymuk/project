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

<?php
//list(,$url)=Yii::$app->assetManager->publish('@bower/sweetalert/dist');
//$this->registerCssFile($url . '/sweetalert.css');
//$this->registerJsFile($url . '/sweetalert.min.js');
//$this->registerJsFile('js/swal.review.create.js', [
//    'depends' => [
//        'yii\web\YiiAsset'
//    ]
//]);
$this->registerJsFile('js/stan.custom.js', [
    'depends' => [
        'yii\web\YiiAsset'
    ]
]);
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
<?= $form->field($model, 'site_url')->textInput()->label('Company site url') ?>
<div class="form-group-director">
<?= $form->field($model, 'director_id')->widget(Select2::classname(), [
    'data' => $directorsData,
    'options' => ['placeholder' => 'Select a state ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
])->label('Director');
?>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#director-create-modal">+</button></div>
<div class="form-group-license">
<?= $form->field($model, 'licenseIds')->widget(Select2::classname(), [
    'data' => [],
    'options' => ['multiple' => true, 'placeholder' => 'Select a state ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
])->label('Licenses');
?>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#license-create-modal">+</button></div>
<div class="form-group-reviews">
<?= $form->field($model, 'reviewIds')->widget(Select2::classname(), [
    'data' => $reviewsData,
    'options' => ['multiple' => true, 'placeholder' => 'Select a state ...'],
    'pluginOptions' => [
    'allowClear' => true
    ],
])->label('Reviews');
?>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#review-create-modal">+</button>
<!--<div class="form-group">-->
    <?= Html::submitButton('Create', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
<!--</div>-->
</div>
<?php ActiveForm::end(); ?>
<?= $this->render('//review/create_modal', ['model' => $review]) ?>
<?= $this->render('//bonus/create_modal', ['model' => $bonus]) ?>
<?= $this->render('//rating/create_modal', ['model' => $rating]) ?>
<?= $this->render('//plus/create_modal', ['model' => $plus]) ?>
<?= $this->render('//minus/create_modal', ['model' => $minus]) ?>
<?= $this->render('//deposit/create_modal', ['model' => $deposit]) ?>
<?= $this->render('//director/create_modal', ['model' => $director]) ?>
<?= $this->render('//license/create_modal', ['model' => $license]) ?>
