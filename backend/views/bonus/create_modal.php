<?php
/**
 * @var $model \common\models\Review
 */
use dosamigos\tinymce\TinyMce;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
?>

<?php $form = ActiveForm::begin(['id' => 'bonus-create-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>
<div id="bonus-create-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create bonus</h4>
            </div>
            <div class="modal-body">
                <p>
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
                    <?= $form->field($model, 'percent')->textInput() ?>
                    <?= $form->field($model, 'currency')->textInput() ?>
                    <?= $form->field($model, 'logoFile')->fileInput() ?>
                    <?= $form->field($model, 'bg_color')->widget(\dpodium\colorpicker\ColorPickerWidget::className(),['id' => 'color-picker', 'name' => 'color-picker'])->label('Background color')
                    ?>
                    <?= $form->field($model, 'price')->textInput() ?>
                    <?= $form->field($model, 'code')->textInput() ?>
                    <?= $form->field($model, 'referal_url')->textInput() ?>
                    <?= $form->field($model, 'rel')->checkbox()->label('Put url rel nofollow') ?>
                    <?= $form->field($model, 'hide_ext_url')->checkbox() ?>
                    <?= $form->field($model, 'type')->checkbox()->label('Main bonus?') ?>

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
                    <?= $form->field($model, 'rollover_title')->textInput() ?>
                    <?= $form->field($model, 'currency')->textInput() ?>
                    <?= $form->field($model, 'rollover_requirement')->textInput() ?>
                    <?= $form->field($model, 'restrictions')->textInput() ?>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <?= Html::submitButton('Create', [
                    'class' => 'btn btn-primary',
                    'id' => 'bonus-create',
                    'name' => 'bonus-button'])
                ?>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
