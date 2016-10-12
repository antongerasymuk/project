<?php
/**
 * @var $review \common\models\Company
 */

use yii\bootstrap\Alert;
use yii\helpers\Url;

$this->title = 'Reviews';
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
        <a href="<?= Url::to(['review/create']) ?>" class="btn btn-primary">Create review</a>
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
                <?php if (empty($reviews)) : ?>
                <?php else : ?>
                    <?php foreach ($reviews as $review) : ?>
                        <tr>
                            <td><?= $review->title ?></td>
                            <td class="center"><?= $review->description ?></td>
                            <td class="center">
                                <?php if (!empty($review->logo)) : ?>
                                    <img src="<?= $review->logo ?>" alt="<?= basename($review->logo) ?>" class="company-logo">
                                <?php endif; ?>
                            </td>
                            <td class="center">
                                <a class="btn btn-info" href="<?= Url::to(['review/edit', 'id' => $review->id]) ?>">
                                    <i class="halflings-icon white edit"></i>
                                </a>
                                <a class="btn btn-danger" href="#">
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