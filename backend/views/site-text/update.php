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
use yii\bootstrap\Alert;

?>
<?php $message = Yii::$app->session->getFlash('success'); ?>
<div class="row-fluid">
    <?php if (!empty($message)) : ?>
        <?= Alert::widget([
            'options' => [
                'class' => 'alert-success',
            ],
            'body' => $message,
        ]);
        ?>
    <?php endif; ?>
</div>


<?php $this->title = 'Update page'; ?>

<?php $form = ActiveForm::begin(['id' => 'page-update-form']); ?>

<?= $form->field($model, 'footer_text_model')->widget(TinyMce::className(), [
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



<?= $form->field($model, 'contact_text_model')->widget(TinyMce::className(), [
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

<?= $form->field($model, 'contact_feedback_model')->widget(TinyMce::className(), [
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

<?= $form->field($model, 'meta_title')->textInput()?>
<?= $form->field($model, 'meta_description')->textInput()?>
<?= $form->field($model, 'meta_keywords')->textInput()?>

<?= Html::submitButton('Update', [ 'id' => "submit_page_update",
    'class' => 'btn btn-primary',
])
?>
<?php ActiveForm::end(); ?>
