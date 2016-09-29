<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
//use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
//use yii\widgets\Breadcrumbs;
use common\widgets\BreadcrumbsBonus;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <header class="hpoker">
				<div class="header-top">
					<div class="container">
						<div class="row">

							<div class="col-sm-3">
								<div class="logo"><a href="<?= Yii::$app->getHomeUrl() ?>"><img src="/images/logo.png" alt=""></a></div>
							</div>

							<div class="col-sm-9">
								<a href="#" class="toggle-menu visible-sm-block visible-xs-block"><span></span></a>
								<nav class="header-menu clearfix">
									<?= \common\widgets\OwnNav::widget([
										'items' => \common\models\Categorie::getForNav()
									]) ?>
								</nav>
							</div>

						</div>
					</div>
				</div>
        <div class="container h-filters">
					<div class="row">
						<div class="col-md-7 pdr0">

							<div class="filter-gp">
								<label>Sort by</label>
								<div class="btns clearfix">
									<button type="button" class="btn-filter lr">Best Poker Site</button>
									<button type="button" class="btn-filter active">Top Bonus %</button>
									<button type="button" class="btn-filter rr">Max Bonus</button>
								</div>
							</div>

							<div class="filter-gp">
								<label>Filter by bonus type</label>
								<div class="btns clearfix">
									<button type="button" class="btn-filter lr">Deposit Bonus</button>
									<button type="button" class="btn-filter active">No Deposit Required</button>
									<button type="button" class="btn-filter rr">Bonus Codes</button>
								</div>
							</div>

						</div>

						<div class="col-md-5 pdl0 clearfix">
							<div class="fc-right">

								<div class="filter-gp clearfix">

									<div class="fsel">
										<label>Banking Options</label>
										<select class="f-select" style="width: 160px;">
											<option value="1">VISA</option>
											<option value="2">PayPal</option>
											<option value="3">MasterCard</option>
											<option value="4">Maestro</option>
									</select>
									</div>

									<div class="fsel">
										<label>Choose Your Country</label>
										<select class="f-select" style="width: 200px;">
											<option value="1">Australia</option>
											<option value="2">China</option>
											<option value="3">Russia</option>
											<option value="4">USA</option>
									</select>
									</div>

								</div>

								<div class="filter-gp clearfix">
									<div class="fcomp">
										<label>By Software Compatibillity</label>
										<div class="btns clearfix">
											<button type="button" class="btn-comp">ANY</button>
											<button type="button" class="btn-comp"><i class="flaticon-os-android"></i></button>
											<button type="button" class="btn-comp active"><i class="flaticon-os-windows"></i></button>
											<button type="button" class="btn-comp"><i class="flaticon-os-mac"></i></button>
										</div>
									</div>

								</div>

							</div>

						</div>
					</div>
				</div><!-- .h-filters -->
			</header>
      <main>
      <div class="main-top">
            <div class="container">
      						<div class="row">
      							<div class="col-sm-8">
      <?= BreadcrumbsBonus::widget([
          'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
      ]) ?>
    </div>
        <div class="col-sm-4 clearfix pdl0">
          <a href="#" class="close-filters">CLOSE FILTERS</a>
        </div>
    </div>
</div>

  </div><!-- .main-top -->
    <div class="container">


        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>
</main>
	<footer>
				<div class="container">
					<div class="row">
						<div class="col-md-9 col-sm-8 col-xs-12">
							<nav class="footer-menu clearfix">
								<ul>
									<li><a href="#">Contact Us</a></li>
									<li><span>·</span></li>
									<li><a href="#">Privacy</a></li>
									<li><span>·</span></li>
									<li><a href="#">Terms and Conditions</a></li>
									<li><span>·</span></li>
									<li><a href="#">Site Map</a></li>
									<li><span>·</span></li>
									<li><a href="#">Glossary</a></li>
								</ul>
							</nav>

							<div class="footer-info">
								It is your responsibility to verify and examine all aspects of your bonus. Please read the terms and conditions carefully.<br/>
We provide no guarantee as to the timeliness or accuracy of the information found on this site.
							</div>

							<div class="copyright hidden-xs">
								<p>Copyright © 2016 <span>bonusonline.co.uk</span>. All Rights Reserved</p>
								<p>Design by <a href="http://perfecto-web.pro" target="_blank">Perfecto Web</a></p>
							</div>

						</div>

						<div class="col-md-3 col-sm-4 col-xs-12 clearfix pdl0 ftx">
							<div class="b-opened">
								<div class="cnt">5 7 3 8 9</div>
								<div class="txt">Bonuses opened</div>
							</div>

							<div class="clearfix"></div>
							<div class="follow">
								<p>Follow us to get new bonuses</p>
								<ul class="clearfix">
									<li class="fb"><a href="#"><i class="flaticon-soc-fb"></i></a></li>
									<li class="tw"><a href="#"><i class="flaticon-soc-tw"></i></a></li>
									<li class="gp"><a href="#"><i class="flaticon-soc-gp"></i></a></li>
								</ul>
							</div>

							<div class="copyright hidden-lg hidden-md hidden-sm visible-xs-block">
								<p>Copyright © 2016 <span>bonusonline.co.uk</span>. All Rights Reserved</p>
								<p>Design by <a href="http://perfecto-web.pro" target="_blank">Perfecto Web</a></p>
							</div>

						</div>

					</div>
				</div>
			</footer><!-- .Footer -->


<?php $this->endBody() ?>
</body>
<script>
	$(function(){
	  $(".f-select").chosen({
	   inherit_select_classes: true,
	   disable_search: true
	 });
	});
</script>
</html>
<?php $this->endPage() ?>
