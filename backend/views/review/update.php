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
<?php $this->title = 'Update review'; ?>

<?php $form = ActiveForm::begin(['id' => 'review-update-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>
<?= $form->field($model, 'title')
         ->textInput(['autofocus' => true])
         ->label('Title')
?>
<?= $form->field($model, 'title_description')->textInput()->label('Title Description')?>
<?= $form->field($model, 'position')->textInput()->label('Alias Category')?>

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
<?= $form->field($model, 'category_id')->widget(Select2::classname(), [
    'data'          => ModelMapHelper::getIdTitleMap(\common\models\Categorie::class),
    'language' => 'en_GB',
    'options'       => ['placeholder' => 'Select a state ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
])->label('Category');
?>

<?= $form->field($model, 'type')
         ->checkbox([
                 'uncheck' => \common\models\Review::REVIEW_TYPE,
                 'value'   => \common\models\Review::COMPANY_TYPE
             ]
         )
         ->label('Company review?');
?>
<?php if (!empty($model->logo)) : ?>
    <div class="form-group" style="background-color: grey;">
        <img src="<?= $model->logo ?>">
    </div>
<?php endif; ?>

<?= $form->field($model, 'bg_color')->widget(\dpodium\colorpicker\ColorPickerWidget::className(),['id' => 'color-picker', 'name' => 'color-picker'])->label('Background color')
?>
<?= $form->field($model, 'logoFile')->fileInput() ?>
<?php if (!empty($model->preview)) : ?>
    <div class="form-group">
        <img src="<?= $model->preview ?>" width="150" height="150">
    </div>
<?php endif; ?>
<?= $form->field($model, 'previewFile')->fileInput() ?>
<?= $form->field($model, 'preview_title')->textInput() ?>
<?= $form->field($model, 'address')->widget(TinyMce::className(), [
    'options'       => [
        'rows' => 6,
    ],
    'language' => 'en_GB',
    'clientOptions' => [
        "init_instance_callback" => "reviewAddressCallback",
        'plugins'                => [
            "advlist autolink lists link charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        'toolbar'                => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    ]
])
?>
<?= $form->field($model, 'bonusIds')->widget(Select2::classname(), [
    'data'          => ModelMapHelper::getIdTitleMap(\common\models\Bonus::class, true),
    'language' => 'en_GB',
    'options'       => ['multiple' => true, 'placeholder' => 'Select a state ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
])->label('Bonuses');
?>
<?= $form->field($model, 'ratingIds')->widget(Select2::classname(), [
    'data'          => ModelMapHelper::getIdTitleMap(\common\models\Rating::class),
    'language' => 'en_GB',
    'options'       => ['multiple' => true, 'placeholder' => 'Select a state ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
])->label('Ratings');
?>
<div class="form-group-select">
<?= $form->field($model, 'plusIds')->widget(Select2::classname(), [
    'data'          => ModelMapHelper::getIdTitleMap(Plus::class, true),
    'language' => 'en_GB',
    'options'       => ['multiple' => true, 'placeholder' => 'Select a state ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
])->label('Pluses');

?>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#plus-create-modal">
+
</button>
</div>
<div class="form-group-select">
<?= $form->field($model, 'minusIds')->widget(Select2::classname(), [
    'data'          => ModelMapHelper::getIdTitleMap(\common\models\Minuse::class, true),
    'language' => 'en_GB',
    'options'       => ['multiple' => true, 'placeholder' => 'Select a state ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
])->label('Minuses');

?>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#minus-create-modal">
+
</button>
</div>

<?= $form->field($model, 'depositIds')->widget(Select2::classname(), [
    'data'          => ModelMapHelper::getIdTitleMap(\common\models\DepositMethod::class),
    'language' => 'en_GB',
    'options'       => ['multiple' => true, 'placeholder' => 'Select a state ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);
?>
<?= $form->field($model, 'osIds')->widget(Select2::classname(), [
    'data'          => ModelMapHelper::getIdTitleMap(\common\models\Os::class),
    'language' => 'en_GB',
    'options'       => ['multiple' => true, 'placeholder' => 'Select a state ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);
?>

<?php $countries = \common\models\Country::getArr(); ?>
<?= $form->field($model, 'deniedIds')->widget(Select2::classname(), [
    'data'          => $countries,
    'language' => 'en_GB',
    'options'       => ['multiple' => true, 'placeholder' => 'Select a state ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);
?>

<?= $form->field($model, 'allowedIds')->widget(Select2::classname(), [
    'data'          => $countries,
    'language' => 'en_GB',
    'options'       => ['multiple' => true, 'placeholder' => 'Select a state ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);
?>
<?php if (!empty($model->gallery)) : ?>
    <div class="form-group">
        <?php foreach ($model->gallery as $img) : ?>
            <img src="<?= $img->src ?>" width="150" height="150">
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<?= $form->field($model, 'gallery[]')->fileInput(['multiple' => true]) ?>

<?= Html::submitButton('Update', [
    'class' => 'btn btn-primary',
])
?>
<?php ActiveForm::end(); ?>
<?= $this->render('//plus/create_modal', ['model' => $plus]) ?>
<?= $this->render('//minus/create_modal', ['model' => $minus]) ?>