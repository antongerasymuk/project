<?php
/**
 * @var $model \common\models\Review
 * @var $bonus \common\models\Bonuse
 */
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

?>

<?php $form = ActiveForm::begin([]); ?>
<?= $form->field($model, 'title')
         ->textInput(['autofocus' => true])
         ->label('Title')
?>
<?= $form->field($model, 'file_label')->textInput() ?>
<?= $form->field($model, 'licenseFile')->fileInput() ?>
<?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>
