<?php
/**
 * @var $model \common\models\Review
 * @var $bonus \common\models\Bonuse
 */
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

?>
<?php $this->title = 'Create review minus' ?>
<?php $form = ActiveForm::begin([
    'action' => \yii\helpers\Url::to(['minus/create', 'isAjax' => false])
]); ?>
<?= $form->field($model, 'title')
         ->textInput(['autofocus' => true])
         ->label('Title')
?>
<?= Html::submitButton('Create', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>
