<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use dosamigos\tinymce\TinyMce;
use yii\bootstrap\Modal;
use kartik\select2\Select2;

/**
 * @var $this \yii\web\View
 * @var $model \common\models\Company
 */
$this->title = 'Oses';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
/**
 * @var $company \common\models\Company
 */

use yii\bootstrap\Alert;
use yii\helpers\Url;

$this->title = 'Oses';
$this->params['breadcrumbs'][] = $this->title;
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
<div class="row-fluid">
    <div class="box span12">
        <a href="<?= Url::to(['os/create']) ?>" class="btn btn-primary">Create os</a>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($oses)) : ?>
                <?php else : ?>
                    <?php foreach ($oses as $os) : ?>
                        <tr>
                            <td><?= $os->title ?></td>
                            <td class="center">
                                <a class="btn btn-info" href="<?= Url::to(['os/edit', 'id' => $os->id]) ?>">
                                    <i class="halflings-icon white edit"></i>
                                </a>
                                <a class="btn btn-danger" 
                                   onclick="Swalt.delete_warning('Os deleting', 
                                   'Os: <?= $os->title ?> will be deleted!',
                                   '<?= Url::to(['license/delete', 'id' => $os->id]) ?>',
                                   'warning')" >
                                    <i class="halflings-icon white trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div><!--/span-->

</div>