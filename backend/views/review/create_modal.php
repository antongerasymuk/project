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
                    
                    <?= $form->field($model, 'meta_title')->textInput()?>
                    <?= $form->field($model, 'meta_description')->textInput()?>
                    <?= $form->field($model, 'meta_keywords')->textInput()?>

                    <?= $form->field($model, 'slug')->textInput()->label('Slug')?>
                    <?= $form->field($model, 'title_description')->textInput()->label('Title Description')?>
                    <?= $form->field($model, 'position')->textInput()->label('Alias Category')?>

                    <?= $form->field($model, 'description')->widget(TinyMce::className(), [
                        'options' => ['rows' => 6],
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
                    <?= $form->field($model, 'category_id')->widget(Select2::classname(), [
                        'data' => ModelMapHelper::getIdTitleMap(\common\models\Categorie::class),
                        'language' => 'en_GB',
                        'options' => ['placeholder' => 'Select a state ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label('Category');
                    ?>

                    <?= $form->field($model, 'type')
                        ->checkbox([
                            'uncheck' => \common\models\Review::REVIEW_TYPE,
                                'value' => \common\models\Review::COMPANY_TYPE
                        ]
                        )
                        ->label('Company review?');
                    ?>
                    <?= $form->field($model, 'bg_color')->widget(\dpodium\colorpicker\ColorPickerWidget::className(),['id' => 'color-picker', 'name' => 'color-picker'])->label('Background color')
                    ?>
                    <?= $form->field($model, 'logoFile')->fileInput() ?>
                    <?= $form->field($model, 'previewFile')->fileInput() ?>
                    <?= $form->field($model, 'preview_title')->textInput() ?>
                    <?= $form->field($model, 'address')->widget(TinyMce::className(), [
                        'options' => [
                            'rows' => 6,
                        ],
                        'language' => 'en_GB',
                        'clientOptions' => [
                            "init_instance_callback" => "reviewAddressCallback",
                            'plugins' => [
                                "advlist autolink lists link charmap print preview anchor",
                                "searchreplace visualblocks code fullscreen",
                                "insertdatetime media table contextmenu paste"
                        ],
                            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                        ]
                    ])
                    ?>
                <div class="form-group-select">
                    <?= $form->field($model, 'bonusIds')->widget(Select2::classname(), [
                        'data' => ModelMapHelper::getIdTitleMap(\common\models\Bonus::class, true),
                        'language' => 'en_GB',
                        'options' => ['multiple' => true, 'placeholder' => 'Select a state ...'],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'maximumSelectionLength'=> 2
                        ],
                    ])->label('Bonuses');
                    ?>

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bonus-create-modal">
                        +
                    </button>
                </div>
                <div class="form-group-select">
                    <?= $form->field($model, 'ratingIds')->widget(Select2::classname(), [
                        'data' => ModelMapHelper::getIdTitleMap(\common\models\Rating::class, true, 'mark'),
                        'language' => 'en_GB',
                        'options' => ['multiple' => true, 'placeholder' => 'Select a state ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label('Ratings');
                    ?>

                    <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#rating-create-modal">+
                    </button>
                </div>
                <div class="form-group-select">
                    <?= $form->field($model, 'plusIds')->widget(Select2::classname(), [
                        'data' => [],
                        'language' => 'en_GB',
                        'options' => ['multiple' => true, 'placeholder' => 'Select a state ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label('Pluses');
                    ?>

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#plus-create-modal">+
                    </button>
            </div>
                <div class="form-group-select">
                    <?= $form->field($model, 'minusIds')->widget(Select2::classname(), [
                        'data' => [],
                        'language' => 'en_GB',
                        'options' => ['multiple' => true, 'placeholder' => 'Select a state ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label('Minuses');
                ?>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#minus-create-modal">
                        +
                    </button>
            </div>
                <div class="form-group-select">
                    <?= $form->field($model, 'depositIds')->widget(Select2::classname(), [
                        'data' => ModelMapHelper::getIdTitleMap(\common\models\DepositMethod::class),
                        'language' => 'en_GB',
                        'options' => ['multiple' => true, 'placeholder' => 'Select a state ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#deposit-create-modal">
                        +
                    </button>
                </div>
                <div class="form-group-select">
                    <?= $form->field($model, 'osIds')->widget(Select2::classname(), [
                        'data' => ModelMapHelper::getIdTitleMap(\common\models\Os::class),
                        'language' => 'en_GB',
                        'options' => ['multiple' => true, 'placeholder' => 'Select a state ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>
                <?php $countries = \common\models\Country::getArr(); ?>

                <div class="btn-group btn-toggle">
                    <button type="button" class="btn switch <?= empty($model->deniedIds)?'btn-active':''; ?>" data-cont="#allowed">Allowed</button>
                    <button type="button" class="btn switch <?= empty($model->deniedIds)?'':'btn-active'; ?>" data-cont="#denied">Denied</button>
                </div>

                <div class="well collapse <?= empty($model->deniedIds)?'in':''; ?>"" id="allowed">
                <?= $form->field($model, 'allowedIds')->widget(Select2::classname(), [
                        'data'          => $countries,
                        'language' => 'en_GB',
                        'options'       => ['multiple' => true, 'placeholder' => 'Select a state ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                ?>
                </div>

                <div class="well collapse <?= empty($model->deniedIds)?'':'in'; ?>" id="denied">
                <?= $form->field($model, 'deniedIds')->widget(Select2::classname(), [
                        'data'          => $countries,
                        'language' => 'en_GB',
                        'options'       => ['multiple' => true, 'placeholder' => 'Select a state ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                ?>
                </div>
                <?= $form->field($model, 'gallery[]')->fileInput(['multiple' => true]) ?>
                </p>
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <?= Html::submitButton('Create', [
                    'class' => 'btn btn-primary',
                    'id' => 'review-create',
                    'name' => 'review-button'
                ])
                ?>
            </div>
    </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
