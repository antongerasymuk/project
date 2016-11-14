<?php
/**
 * @var $model \common\models\Review
 * @var $bonus \common\models\Bonuse
 */
use dosamigos\tinymce\TinyMce;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

?>

<?php $form = ActiveForm::begin([
    'action' => \yii\helpers\Url::to(['director/create', 'isAjax' => false])
]); ?>
<?= $form->field($model, 'title')->textInput() ?>
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
<?= $form->field($model, 'photoFile')->fileInput() ?>
<?= Html::submitButton('Create', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>
