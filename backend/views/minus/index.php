<?php
/**
 * @var $review \common\models\Company
 */

use yii\bootstrap\Alert;
use yii\helpers\Url;

$this->title = 'Review minuses';
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
        <a href="<?= Url::to(['minus/create']) ?>" class="btn btn-primary">Create review minus</a>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($minuses)) : ?>
                <?php else : ?>
                    <?php foreach ($minuses as $minus) : ?>
                        <tr>
                            <td><?= $minus->title ?></td>
                            <td class="center">
                                <a class="btn btn-info" href="<?= Url::to(['minus/edit', 'id' => $minus->id]) ?>">
                                    <i class="halflings-icon white edit"></i>
                                </a>
                                <a class="btn btn-danger" href="<?= Url::to(['minus/delete', 'id' => $minus->id]) ?>">
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