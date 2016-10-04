
<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;


$this->title = 'SiteMap';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
	<div class="static-content">
       <bookmaker-bonuses-list params="{companies_list}"></bookmaker-bonuses-list>
       <?php $this->registerJsFile('/js/bookmaker_bonuses_list.js', ['depends' => [frontend\assets\AppAsset::className()]]); ?>
   
      

		<h3>Other</h3>
		<div class="bonuses-other-items">
        <?= \common\widgets\BonusesOtherItems::widget([
									'items' => \common\models\Categorie::getForNav()
									]) ?>

			

			<div class="item">
				<div class="tit">Bookmaker Offers</div>
				<ul>
					<li><a href="#">Free Bets</a></li>
					<li><a href="#">Free Bet Codes</a></li>
				</ul>
			</div>	

			<div class="item">
				<div class="tit">Navigation</div>
				<ul>
					<li><a href="#">Home</a></li>
					<li><a href="#">About Us</a></li>
					<li><a href="#">Privacy Policy</a></li>
					<li><a href="#">Terms and Conditions</a></li>
					<li><a href="#">Site Map</a></li>																														
				</ul>
			</div>	

			<div class="item">
				<div class="tit">Site Information</div>
				<ul>
					<li><a href="#">About Us</a></li>
					<li><a href="#">Privacy Policy</a></li>
					<li><a href="#">Terms and Conditions</a></li>
					<li><a href="#">Conditions</a></li>
					<li><a href="#">Glossary</a></li>																														
				</ul>
			</div>	

			<div class="item">
				<div class="tit">Other</div>
				<ul>
					<li><a href="#">Deposit Methods</a></li>																												
				</ul>
			</div>	

		</div> <!-- .bonuses-other-items -->
	</div>
</div>