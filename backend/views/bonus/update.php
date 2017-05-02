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
<td class="center">
    <?php if (!empty($model->logo)) : ?>
        <img src="<?= $model->logo ?>" alt="<?= basename($model->logo) ?>" class="company-logo">
    <?php endif; ?>
</td>
<?= $form->field($model, 'logoFile')->fileInput() ?>
<?= $form->field($model, 'bg_color')->widget(\dpodium\colorpicker\ColorPickerWidget::className(),['id' => 'color-picker', 'name' => 'color-picker'])->label('Background color')
?>
<?= $form->field($model, 'price')->textInput() ?>
<?= $form->field($model, 'percent')->textInput() ?>
<?= $form->field($model, 'code')->textInput() ?>
<?= $form->field($model, 'referal_url')->textInput() ?>
<?= $form->field($model, 'rel')->checkbox()->label('Put url rel nofollow') ?>
<?= $form->field($model, 'hide_ext_url')->checkbox() ?>
<div class="form-group">
    <div class="checkbox">
        <label data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
            <?= $form->field($model, 'check_dep')->checkbox()->label('Deposit', ['style'=>'margin-top: 0px;']) ?>
        </label>
    </div>

    <div id="collapseOne" aria-expanded="false" class="collapse <?= ($model->check_dep)? 'in':'' ?>">
        <div class="well"><?= $form->field($model, 'min_deposit')->textInput() ?></div>
    </div>
    <div class="checkbox">
        <label>
            <?= $form->field($model, 'check_no_dep')->checkbox()->label('No deposit', ['style'=>'margin-top: 0px;']) ?>
        </label>
    </div>
</div>

<?= $form->field($model, 'expiry')->textInput() ?>
<?= $form->field($model, 'rollover_requirement')->textInput() ?>
<?= $form->field($model, 'restrictions')->textInput() ?>
<?= $form->field($model, 'rollover_title')->textInput() ?>
<?= $form->field($model, 'currency')->textInput() ?>
<?= $form->field($model, 'type')->checkbox()->label('Main bonus?') ?>



<div class="form-group">
    <?= Html::submitButton('Update', ['class' => 'btn btn-primary', 'name' => 'category-button']) ?>
</div>
<?php ActiveForm::end(); ?>
