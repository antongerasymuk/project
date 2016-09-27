<?php
use yii\helpers\Html;
$filter = "Poker";
$this->title = "$filter Sites";
$this->params['breadcrumbs'][] = $this->title;?>

<bonuses-filter-list params="{bonuses_list}" filter='<?= $filter ?>'></bonuses-filter-list>

<div class="clearfix"></div>

<div class="static-content">
  <p class="text-center"><strong>Welcome to Bonus Online <?= $filter ?>, the site that allows you to find and compare the latest <?= strtolower($filter) ?> bonus offers. Read reviews and compare offers to find the perfect choice for you. All <?= strtolower($filter) ?>  providers have been hand-picked by Sign Up Bonuses as trusted online operators. You can see at a glance the promotions that require a deposit and the ones you can play for free, no deposit required. Click <span style="color: #e6a714;">‘Get Bonus’</span> to receive extra free chips and start playing now!</strong></p>

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
