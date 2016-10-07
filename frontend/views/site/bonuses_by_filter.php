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
  echo $key ;
  if ($key != 'id') {
    $get_url .=  '&'.$key.'='.$value;
}
$get_json = json_encode($get);
}



$request->get(); ?>
<?php $this->registerJsFile('/js/bonus_filter.js', ['depends' => 'frontend\assets\AppAsset']); ?>
<?php $this->registerJsFile('/js/filter.js', ['depends' => 'frontend\assets\AppAsset']); ?>
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
    <?php $this->registerJsFile('/js/bonuses_list.js', ['depends' => [frontend\assets\AppAsset::className()]]); ?>
    </tbody>
    </table>
                            
                        </div>


<div class="clearfix"></div>

<div class="static-content">
    <p class="text-center"><strong>Welcome to Bonus Online <?= $title ?>, the site that allows you to find and compare the latest <?= strtolower($title) ?> bonus offers. Read reviews and compare offers to find the perfect choice for you. All <?= strtolower($title) ?>  providers have been hand-picked by Sign Up Bonuses as trusted online operators. You can see at a glance the promotions that require a deposit and the ones you can play for free, no deposit required. Click <span style="color: #e6a714;">‘Get Bonus’</span> to receive extra free chips and start playing now!</strong></p>

    <div class="info-block">
        <span><strong>Please Note:</strong></span>
        <ul class="list-disc">
            <li>By using this website you are agreeing to comply with and be bound by the Sign Up Bonuses terms and conditions of use, which together with our privacy policy govern our relationship with you in relation to this website:
                www.bonusonline.co.uk/terms-and-conditions.html.</li>

                <li>You will be subject to the terms and conditions of the casino you select. View the website of your selected casino for further information.</li>
                <li>The casino reserves the right at any time and from time to time to modify or discontinue, temporarily or permanently, this promotion with prior notice.</li>
                <li>Bonus offers may be subject to expiry limits. For example, new customers may have 30 days upon receipt of the bonus to fulfil all related wagering requirements.</li>
                <li>A minimum and maximum wager may be required. Game types available as part of the bonus offer may vary and some game types may be excluded. Note the minimum and maximum bonus available and the deposit required for your selected bonus.</li>
                <li>Some casinos require a code to be entered to get the bonus. Enter the code shown below 'Get Bonus' when you sign up.</li>
                <li>Your selected offer may require you to register as a new customer and some offers may be unavailable to pre-existing customers of that casino. One offer may only be available per customer. A credit or debit card will be required when you sign up, even if you choose a bonus offer for which no deposit is required.</li>
                <li>The percentage bonus received may differ dependent on the type of game played. The amount to be wagered to receive the bonus may therefore differ depending on game types you choose to play.</li>
                <li>Players must be over 18. Providing false information relating to age, name and address may constitute an offence.</li>
                <li>The promotion will be governed by the law of England and Wales and the parties submit to the exclusive jurisdiction of the English courts. You are solely responsible for checking the laws regarding the use of internet gaming in the jurisdiction in which you are located.</li>

            </ul>
        </div>

    </div>
