<?php
/**
 * @var $company \common\models\Company
 */

use yii\bootstrap\Alert;
use yii\helpers\Url;

$this->title = 'Payment methods';
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
        <a href="<?= Url::to(['payment/create']) ?>" class="btn btn-primary">Create payment method</a>
        <div class="box-header" data-original-title>
            <h2><i class="icon-building"></i><span class="break"></span>Payment methods</h2>
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
                    <th>Logo</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($payments)) : ?>
                <?php else : ?>
                    <?php foreach ($payments as $payment) : ?>
                        <tr>
                            <td><?= $payment->title ?></td>
                            <td class="center">
                                <img src="<?= $payment->logo ?>">
                            </td>
                            <td class="center">
                                <a class="btn btn-info" href="<?= Url::to(['payment/edit', 'id' => $payment->id]) ?>">
                                    <i class="halflings-icon white edit"></i>
                                </a>
                                <a class="btn btn-danger" 
                                   onclick="Swalt.delete_warning('Payment method deleting', 
                                   'Payment method &#34; <?= $payment->title ?> &#34; will be deleted!',
                                   '<?= Url::to(['payment/delete', 'id' => $payment->id]) ?>',
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