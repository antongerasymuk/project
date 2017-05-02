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
<?= $form->field($model, 'title_description')->textInput()->label('Title Description')?>
<?= $form->field($model, 'file_label')->textInput() ?>
<?php if (!empty($model->url)) : ?>
    <div class="form-group">
        <a href="<?= $model->url ?>"><?= $model->file_label ?></a>
    </div>
<?php endif; ?>
<?= $form->field($model, 'url')->textInput() ?>
<?= $form->field($model, 'rel')->checkbox()->label('Put url rel nofollow') ?>
<?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>
