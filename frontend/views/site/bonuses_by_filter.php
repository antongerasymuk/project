<?php
use yii\helpers\Html;
use frontend\assets\AppAsset;
/**
 * @var $this \yii\web\View
 */
$this->title = ucfirst($title)." Sites";
$this->params['breadcrumbs'][] = $this->title;
$request = Yii::$app->request;
AppAsset::register($this);
?>

<?php $get = $request->get(); ?>
<?php 
$get_url = '';
foreach ($get as $key => $value) {
  
  if ($key != 'id') {
    $get_url .=  '&'.$key.'='.$value;
}
$get_json = json_encode($get);
$texts_json = json_encode($texts);
$meta_tags_json = json_encode($metaTags);
}
$request->get(); ?>

<script>
    texts = <?= $texts_json?>;
    
    main_text = null;
    notes = null;
    list_title = null;

    meta_tags = <?= $meta_tags_json?>;
</script>


<!--<?php //$this->registerJsFile('/js/bonus_filter.js', ['depends' => 'frontend\assets\AppAsset']); ?>-->
<!--<?php //$this->registerJsFile('/js/filter.js', ['depends' => 'frontend\assets\AppAsset']); ?>-->

<div class="row"  riot-tag="bonuses-filter-list" id="bonuses-filter-list" params="{bonuses_list}" category='<?= $get["id"] ?>'  filter='<?= $get_url ?>' get='<?= $get_json ?>' title='<?= ucfirst($title) ?>' >
</div>

