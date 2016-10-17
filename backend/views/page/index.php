<?php
/**
 * @var $review \common\models\Company
 */

use yii\bootstrap\Alert;
use yii\helpers\Url;

$this->title = 'Pages';
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
        <a href="<?= Url::to(['page/create']) ?>" class="btn btn-primary">Create page</a>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Slug</th>
                    <th>Content</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($sites)) : ?>
                <?php else : ?>
                    <?php foreach ($sites as $site) : ?>
                        <tr>
                            <td><?= $site->title ?></td>
                            <td class="center"><?= $site->category ?></td>
                            <td class="center"><?= $site->slug ?></td>
                            <td class="center"><?= $rest = substr("$site->content", 0, 80);?></td>
                            <td class="center">
                                <a class="btn btn-info" href="<?= Url::to(['page/edit', 'id' => $site->id]) ?>">
                                    <i class="halflings-icon white edit"></i>
                                </a>
                                 <a class="btn btn-danger" 
                                   onclick="Swalt.delete_warning('Site deleting', 
                                   'Site: <?= $site->title ?> will be deleted!',
                                   '<?= Url::to(['site/delete', 'id' => $site->id]) ?>',
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
