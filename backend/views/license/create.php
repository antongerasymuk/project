<?php
/**
 * @var $model \common\models\Review
 * @var $bonus \common\models\Bonuse
 */
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

?>

<?php $form = ActiveForm::begin([
    'action' => \yii\helpers\Url::to(['license/create', 'isAjax' => false])
]); ?>
<?= $form->field($model, 'title')
         ->textInput(['autofocus' => true])
         ->label('Title')
?>
<?= $form->field($model, 'title_description')->textInput()->label('Title Description')?>
<?= $form->field($model, 'file_label')->textInput() ?>
<?= $form->field($model, 'url')->textInput() ?>
<?= Html::submitButton('Create', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>
