<?php
/**
 * @var $model \common\models\Review
 * @var $bonus \common\models\Bonuse
 */
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

?>

<?php $form = ActiveForm::begin([]); ?>
<?= $form->field($model, 'title')->textInput() ?>
<?= $form->field($model, 'description')->widget(\dosamigos\tinymce\TinyMce::className(), [
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
<?php if (!empty($model->photo)) : ?>
    <div class="form-group">
        <img src="<?= $model->photo ?>" width="70" height="50">
    </div>
<?php endif; ?>
<?= $form->field($model, 'photoFile')->fileInput() ?>
<?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>
