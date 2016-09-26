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
<?= $form->field($model, 'logoFile')->fileInput()->label('Logo file') ?>
<?= $form->field($model, 'site_url')->textInput()->label('Company site url') ?>
<?= $form->field($model, 'reviewIds')->widget(Select2::classname(), [
    'data' => $reviewsData,
    'language' => 'en',
    'options' => ['multiple' => true, 'placeholder' => 'Select a state ...'],
    'pluginOptions' => [
    'allowClear' => true
    ],
])->label('Reviews');
?>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#review-create-modal">+</button>
<div class="form-group">
    <?= Html::submitButton('Create', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
</div>

<?php ActiveForm::end(); ?>

<?= $this->render('//review/create_modal', ['model' => $review]) ?>
<?= $this->render('//bonus/create_modal', ['model' => $bonus]) ?>
