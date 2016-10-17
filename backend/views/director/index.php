<?php
/**
 * @var $review \common\models\Company
 */

use yii\bootstrap\Alert;
use yii\helpers\Url;

$this->title = 'Directors';
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
        <a href="<?= Url::to(['director/create']) ?>" class="btn btn-primary">Create director</a>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Photo</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($directors)) : ?>
                <?php else : ?>
                    <?php foreach ($directors as $director) : ?>
                        <tr>
                            <td><?= $director->title ?></td>
                            <td><?= $director->description ?></td>
                            <td>
                                <?php if (!empty($director->photo)) : ?>
                                    <img src="<?= $director->photo ?>" width="70" height="50">
                                <?php endif; ?>
                            </td>
                            <td class="center">
                                <a class="btn btn-info" href="<?= Url::to(['director/edit', 'id' => $director->id]) ?>">
                                    <i class="halflings-icon white edit"></i>
                                </a>
                                <a class="btn btn-danger" 
                                   onclick="Swalt.delete_warning('Company deleting', 
                                   'Director: <?= $director->title ?> will be deleted!',
                                   '<?= Url::to(['director/delete', 'id' => $director->id]) ?>',
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