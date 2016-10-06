<?php
use yii\helpers\Html;

/**
 * @var $this \yii\web\View
 */
$this->title = ucfirst($title)." Sites";
$this->params['breadcrumbs'][] = [
    'url' => ['site/sitemap'],
    'label' => 'Sites'];
$this->params['breadcrumbs'][] = $this->title;
$request = Yii::$app->request;
?>
<?= Html::decode($content); ?>
<!--<?php $get = $request->get(); ?>
<?=  var_dump($get);?>-->