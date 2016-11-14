<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use dosamigos\tinymce\TinyMce;
use kartik\color\ColorInput;
use yii\bootstrap\Modal;
use kartik\select2\Select2;
use \common\helpers\ModelMapHelper;

/**
 * @var $this \yii\web\View
 * @var $model \common\models\Company
 */
$this->title = 'Create bonus';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin(['id' => 'bonus-form', 'options' => ['enctype' => 'multipart/form-data'],'action' => \yii\helpers\Url::to(['bonus/create', 'isAjax' => false])]); ?>
<?= $form->field($model, 'title')
         ->textInput(['autofocus' => true])
         ->label('Title')
?>
<?= $form->field($model, 'title_description')->textInput()->label('Title Description')?>
<?= $form->field($model, 'description')->widget(TinyMce::className(), [
    'options'       => ['rows' => 6],
    'language' => 'en_GB',
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
<?= $form->field($model, 'logoFile')->fileInput() ?>
<?= $form->field($model, 'price')->textInput() ?>
<?= $form->field($model, 'code')->textInput() ?>
<?= $form->field($model, 'referal_url')->textInput() ?>
<?= $form->field($model, 'rollover_requirement')->textInput() ?>
<?= $form->field($model, 'rollover_title')->textInput() ?>
<?= $form->field($model, 'type')->checkbox() ?>

<?= $form->field($model, 'osIds')->widget(Select2::classname(), [
    'data'          => ModelMapHelper::getIdTitleMap(\common\models\Os::class),
    'language' => 'en_GB',
    'options'       => ['multiple' => true, 'placeholder' => 'Select a state ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);
?>

<div class="form-group">
    <?= Html::submitButton('Create', ['class' => 'btn btn-primary', 'name' => 'category-button']) ?>
</div>
<?php ActiveForm::end(); ?>
