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
<?php $this->title = 'Create Rating'; ?>

<?php $form = ActiveForm::begin(['id' => 'page-create-form', 'action' => \yii\helpers\Url::to(['rating/create', 'isAjax' => false])]); ?>
<?= $form->field($model, 'title')
         ->textInput(['autofocus' => true])
         ->label('Title')
?>
<?= $form->field($model, 'mark')->widget(Select2::classname(), [
    'data'          => [0,1,2,3,4,5,6,7,8,9,10],
    'language' => 'en_GB',
    'options'       => [],
    'pluginOptions' => [],
]);
?>




<?= Html::submitButton('Create', [ 'id' => "submit_page_create",
    'class' => 'btn btn-primary',
])
?>
<?php ActiveForm::end(); ?>
