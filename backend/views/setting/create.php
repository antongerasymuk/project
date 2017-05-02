<?php
/**
 * @var $model \common\models\Review
 * @var $bonus \common\models\Bonuse
 */
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

?>

<?php $form = ActiveForm::begin([]); ?>
<?= $form->field($model, 'username')
         ->textInput(['autofocus' => true])
         ->label('Login')
?>
<?= $form->field($model, 'password')
         ->passwordInput()
         ->label('Password')
?>
<?= $form->field($model, 'pass_confirm')
         ->passwordInput()
         ->label('Password confirm')
?>
<?= Html::submitButton('Create', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>
