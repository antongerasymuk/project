<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use dosamigos\tinymce\TinyMce;
use kartik\color\ColorInput;
use yii\bootstrap\Modal;

/**
 * @var $this \yii\web\View
 * @var $model \common\models\Company
 */
$this->title = 'Create bonus';
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
<?= $form->field($model, 'fileLogo')->fileInput() ?>
<?= $form->field($model, 'price')->textInput() ?>
<?= $form->field($model, 'code')->textInput() ?>
<?= $form->field($model, 'referal_url')->textInput() ?>
<?= $form->field($model, 'type')->checkbox() ?>
<?php ActiveForm::end(); ?>
