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
									<button type="button" data-type="sort" data-filter="1" class="btn-filter lr">Best <?php echo empty($this->params['category_title']) ? '' : $this->params['category_title']; ?> Site</button>
									<button type="button" data-type="sort" data-filter="2" class="btn-filter ">Top Bonus %</button>
									<button type="button" data-type="sort" data-filter="3" class="btn-filter rr">Max Bonus</button>
								</div>
							</div>
							<div class="filter-gp">
								<label>Filter by bonus type</label>
								<div class="btns clearfix">
									<button type="button" data-type="filter" data-filter="1" class="btn-filter lr">Deposit Bonus</button>
									<button type="button" data-type="filter" data-filter="0" class="btn-filter">No Deposit Required</button>
									<button type="button" data-type="filter" data-filter="2" class="btn-filter rr">Bonus Codes</button>
								</div>
							</div>
						</div>

						<div class="col-md-5 pdl0 clearfix">
							<div class="fc-right">

								<div class="filter-gp clearfix">

									<div class="fsel">
										<label>Banking Options</label>
										<?= \common\widgets\DepositMethods::widget() ?>
									</div>

									<div class="fsel">
										<label>Choose Your Country</label>
										<?= \common\widgets\Countries::widget() ?>
									</div>
								</div>

								<div class="filter-gp clearfix">
									<div class="fcomp">
										<label>By Software Compatibillity</label>
										<?php $oses = \common\models\Os::find()->all(); ?>
										<div class="btns clearfix">
											<button type="button" class="btn-comp" data-type="os" data-filter="0">ANY</button>
											<?php if (!empty($oses)) : ?>
                                                <?php foreach ($oses as $os) : ?>
                                                    <button type="button" class="btn-comp" data-type="os" data-filter="<?= $os->id ?>">
                                                        <i class="flaticon-os-<?= strtolower($os->title) ?>"></i>
                                                    </button>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
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
								<?= \common\widgets\FooterNav::widget([
									'items' => \common\models\Site::getForOther()['footer']
									]); ?>


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
							<div class="cnt"><?= \common\models\Bonus::find()->count() ?></div>
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
