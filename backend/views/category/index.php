<?php
/**
 * @var $company \common\models\Company
 */

use yii\bootstrap\Alert;
use yii\helpers\Url;

$this->title = 'Categories';
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
        <a href="<?= Url::to(['category/create']) ?>" class="btn btn-primary">Create category</a>
        <div class="box-header" data-original-title>
            <h2><i class="icon-building"></i><span class="break"></span>Categories</h2>
            <div class="box-icon">
                <!--				<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>-->
                <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($categories)) : ?>
                <?php else : ?>
                    <?php foreach ($categories as $cat) : ?>
                        <tr>
                            <td><?= $cat->title ?></td>
                            <td class="center">
                                <a class="btn btn-info" href="<?= Url::to(['category/edit', 'id' => $cat->id]) ?>">
                                    <i class="halflings-icon white edit"></i>
                                </a>
                                <a class="btn btn-danger" 
                                   onclick="Swalt.delete_warning('Category deleting', 
                                   'Category &#34;<?= $cat->title ?>&#34; will be deleted!',
                                   '<?= Url::to(['category/delete', 'id' => $cat->id]) ?>',
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