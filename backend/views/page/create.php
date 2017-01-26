<?php
/**
 * @var $model \common\models\Review
 * @var $bonus \common\models\Bonus
 */
use dosamigos\tinymce\TinyMce;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use \common\helpers\ModelMapHelper;
use \common\models\Plus;

?>
<?php $this->title = 'Create page'; ?>

<?php $form = ActiveForm::begin(['id' => 'page-create-form']); ?>
<?= $form->field($model, 'title')
         ->textInput(['autofocus' => true])
         ->label('Title')
?>
<?= $form->field($model, 'content')->widget(TinyMce::className(), [
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
<?= $form->field($model, 'slug')
         ->textInput()
         ->label('Slug')
?>

<?= $form->field($model, 'category')
         ->textInput()
         ->label('Category')
?>

<?= Html::submitButton('Update', [ 'id' => "submit_page_update",
    'class' => 'btn btn-primary',
])
?>
<?php ActiveForm::end(); ?>
