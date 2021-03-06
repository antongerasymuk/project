<?php
/**
 * @var $review \common\models\Company
 */

use yii\bootstrap\Alert;
use yii\helpers\Url;

$this->title = 'Lisences';
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
        <a href="<?= Url::to(['license/create']) ?>" class="btn btn-primary">Create license</a>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                <tr>
                    <th>Title Description </th>
                    <th>File</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($licenses)) : ?>
                <?php else : ?>
                    <?php foreach ($licenses as $license) : ?>
                        <tr>
                            <td><?= $license->title_description ?></td>
                            <td class="center">
                                <a href="<?= $license->url ?>"><?= $license->file_label ?></a>
                            </td>
                            <td class="center">
                                <a class="btn btn-info" href="<?= Url::to(['license/edit', 'id' => $license->id]) ?>">
                                    <i class="halflings-icon white edit"></i>
                                </a>
                                <a class="btn btn-danger" 
                                   onclick="Swalt.delete_warning('License deleting', 
                                   'License &#34;<?= $license->title ?>&#34; will be deleted!',
                                   '<?= Url::to(['license/delete', 'id' => $license->id]) ?>',
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