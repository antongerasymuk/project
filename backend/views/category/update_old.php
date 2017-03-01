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
$this->title = 'Update category';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin(['id' => 'category-form']); ?>

<?= $form->field($model, 'meta_title')->textInput()?>
<?= $form->field($model, 'meta_description')->textInput()?>
<?= $form->field($model, 'meta_keywords')->textInput()?>

<?= $form->field($model, 'title')->textInput() ?>
<?= $form->field($model, 'pos')->textInput()->label('Index Position') ?>

<div class="well">
    <h2 class="text-center"><strong >Deposit Page</strong></h2>
    <?= $form->field($model, 'list_title')->textInput()->label('List Title')?>

    <?= $form->field($model, 'main_text')->widget(TinyMce::className(), [
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

    <?= $form->field($model, 'notes')->widget(TinyMce::className(), [
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
</div>

<div class="well">
    <h2 class="text-center"><strong >No-deposit Page</strong></h2>
    <?= $form->field($model, 'no_deposit_list_title')->textInput()->label('No deposit list title')?>

    <?= $form->field($model, 'no_deposit_main_text')->widget(TinyMce::className(), [
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

    <?= $form->field($model, 'no_deposit_notes')->widget(TinyMce::className(), [
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
</div>

<div class="well">
    <h2 class="text-center"><strong >Code Page</strong></h2>
    <?= $form->field($model, 'code_list_title')->textInput()->label('Code list title')?>

    <?= $form->field($model, 'code_main_text')->widget(TinyMce::className(), [
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

    <?= $form->field($model, 'code_notes')->widget(TinyMce::className(), [
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
</div>

<div class="form-group">
    <?= Html::submitButton('Update', ['class' => 'btn btn-primary', 'name' => 'category-button']) ?>
</div>

<?php ActiveForm::end(); ?>
