<?php
/**
 * @var $model \common\models\Review
 */
use dosamigos\tinymce\TinyMce;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
?>

<?php $form = ActiveForm::begin(['id' => 'review-create-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>
<div id="review-create-modal" class="modal modal-content fade" role="dialog">

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
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <?= Html::submitButton('Create', [
                    'class' => 'btn btn-primary',
                    'id' => 'review-create',
                    'name' => 'review-button']) ?>
            </div>
            <div id="preloader" class="preloader" style="display: none;"></div>
        </div>
</div>
<?php ActiveForm::end(); ?>
