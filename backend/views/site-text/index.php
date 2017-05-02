
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

<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#panel1">Contact Page</a></li>
    <li><a data-toggle="tab" href="#panel2">Main Page</a></li>
    <li><a data-toggle="tab" href="#panel3">SiteMap Page</a></li>
</ul>

<div class="tab-content">
    <div id="panel1" class="tab-pane fade in active">
        <div class="well">
            <h2 class="text-center"><strong >Contact Page</strong></h2>

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

            <?= $form->field($model, 'contact_title_model')->textInput()->label('Contact Title')?>
            <?= $form->field($model, 'contact_subtitle_model')->textInput()->label('Contact Subtitle')?>

        </div>
    </div>
    <div id="panel2" class="tab-pane fade">
        <div class="well">
            <h2 class="text-center"><strong >Main Page</strong></h2>
            <?= $form->field($model, 'meta_title')->textInput()?>
            <?= $form->field($model, 'meta_description')->textInput()?>
            <?= $form->field($model, 'meta_keywords')->textInput()?>

            <?= $form->field($model, 'main_text_model')->widget(TinyMce::className(), [
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

            <?= $form->field($model, 'main_list_title_model')->textInput()->label('Main List Title')?>
            <?= $form->field($model, 'main_title_model')->textInput()->label('Main Title')?>
            <?= $form->field($model, 'main_subtitle_model')->textInput()->label('Main Subtitle')?>
        </div>
    </div>
    <div id="panel3" class="tab-pane fade">
        <div class="well">
            <h2 class="text-center"><strong >SiteMap Page</strong></h2>
            <?= $form->field($model, 'sitemap_title_model')->textInput()->label('Sitemap Title')?>
        </div>
    </div>
</div>


<?= Html::submitButton('Update', [ 'id' => "submit_page_update",
        'class' => 'btn btn-primary',
    ])
?>
<?php ActiveForm::end(); ?>
