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
$this->title = 'Update bonus';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin(['id' => 'bonus-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>
<?= $form->field($model, 'title')
         ->textInput(['autofocus' => true])
         ->label('Title')
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
<td class="center">
    <?php if (!empty($model->logo)) : ?>
        <img src="<?= $model->logo ?>" alt="<?= basename($model->logo) ?>" class="company-logo">
    <?php endif; ?>
</td>
<?= $form->field($model, 'logoFile')->fileInput() ?>
<?= $form->field($model, 'price')->textInput() ?>
<?= $form->field($model, 'code')->textInput() ?>
<?= $form->field($model, 'referal_url')->textInput() ?>
<?= $form->field($model, 'type')->checkbox() ?>

<?= $form->field($model, 'osIds')->widget(Select2::classname(), [
    'data'          => ModelMapHelper::getIdTitleMap(\common\models\Os::class),
    'language'      => 'en',
    'options'       => ['multiple' => true, 'placeholder' => 'Select a state ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);
?>

<div class="form-group">
    <?= Html::submitButton('Update', ['class' => 'btn btn-primary', 'name' => 'category-button']) ?>
</div>
<?php ActiveForm::end(); ?>
