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
}



$request->get(); ?>
<!--<?php //$this->registerJsFile('/js/bonus_filter.js', ['depends' => 'frontend\assets\AppAsset']); ?>-->
<!--<?php //$this->registerJsFile('/js/filter.js', ['depends' => 'frontend\assets\AppAsset']); ?>-->
<div class="row">
    <div class="h-title"><h1>The UK's Top 15 <?= ucfirst($title) ?> Sites</h1></div>

    <div class="col-xs-12">
        <table class="table-top-sites"  style="table-layout:fixed;">
            <thead>
                <tr>
                    <th class="text-center" style="width:7%;">Rank</th>
                    <th class="text-left"   style="width:18%;"><?= ucfirst($title) ?> Site</th>
                    <th class="text-left"  style="width:9.5%;">Rating</th>
                    <th class="text-left" style="width:28%;">Bonus Details</th>
                    <th class="text-center" style="width:17%;">Compatible with</th>
                    <th class="text-center" style="width:20.5%;">Join site</th>
                </tr>
            </thead>
            <tbody riot-tag="bonuses-filter-list" id="bonuses-filter-list" params="{bonuses_list}" category='<?= $get["id"] ?>' filter='<?= $get_url ?>' get='<?= $get_json ?>' title='<?= ucfirst($title) ?>' > 

<!--<tr><bonuses-filter-list id="bonuses-filter-list" params="{bonuses_list}" category='<?= $get["id"] ?>' filter=''' title='<?= ucfirst($title) ?>'></bonuses-filter-list></tr>-->
    <!--<?php //$this->registerJsFile('/js/bonuses_list.js', ['depends' => [frontend\assets\AppAsset::className()]]); ?>-->
    </tbody>
    </table>
                            
                        </div>


<div class="clearfix"></div>

    
    <div class="static-content">
    <p class="text-center"><?= $main_text; ?></p>

    <div class="info-block">
        <span><strong>Please Note:</strong></span>
        <ul class="list-disc">
            <?= $notes; ?>
         </ul>
     </div>

    </div>
