<?php
/**
 * @var $model \common\models\Review
 * @var $bonus \common\models\Bonuse
 */
use dosamigos\tinymce\TinyMce;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
?>

<?php $form = ActiveForm::begin(['id' => 'review-create-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>
<div id="review-create-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create review</h4>
            </div>
            <div class="modal-body">
                <p>
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
                    <?= $form->field($model, 'previewFile')->fileInput() ?>
                    <?= $form->field($model, 'address')->widget(TinyMce::className(), [
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
                    <?= $form->field($model, 'bonusIds')->widget(Select2::classname(), [
                        'data' => [],
                        'language' => 'en',
                        'options' => ['multiple' => true, 'placeholder' => 'Select a state ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label('Bonuses');
                    ?>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bonus-create-modal">+</button>
                    <?= $form->field($model, 'ratingIds')->widget(Select2::classname(), [
                        'data' => [],
                        'language' => 'en',
                        'options' => ['multiple' => true, 'placeholder' => 'Select a state ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label('Ratings');
                    ?>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#rating-create-modal">+</button>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <?= Html::submitButton('Create', [
                    'class' => 'btn btn-primary',
                    'id' => 'review-create',
                    'name' => 'review-button'])
                ?>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
