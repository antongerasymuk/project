<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\bootstrap\Alert;
$this->title = 'Dashboard';
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
        <a href="<?= Url::to(['bonus/create']) ?>" class="btn btn-primary">Create bonus</a>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Logo</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($bonuses)) : ?>
                <?php else : ?>
                    <?php foreach ($bonuses as $bonus) : ?>
                        <tr>
                            <td><?= $bonus->title ?></td>
                            <td class="center"><?= $bonus->description ?></td>
                            <td class="center">
                                <?php if (!empty($bonus->logo)) : ?>
                                    <img src="<?= $bonus->logo ?>" alt="<?= basename($bonus->logo) ?>" class="company-logo">
                                <?php endif; ?>
                            </td>
                            <td class="center">
                                <a class="btn btn-info" href="<?= Url::to(['bonus/edit', 'id' => $bonus->id]) ?>">
                                    <i class="halflings-icon white edit"></i>
                                </a>
                                <a class="btn btn-danger" 
                                   onclick="Swalt.delete_warning('Bonus deleting', 
                                   'bonus <?= $bonus->title ?> well deleted!',
                                   '<?= Url::to(['bonus/delete', 'id' => $bonus->id]) ?>',
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