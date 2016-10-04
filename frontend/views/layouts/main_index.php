<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\CHtml;   
use frontend\assets\AppAsset;

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
    <header class="home">
				<div class="header-top">
					<div class="container">
						<div class="row">

							<div class="col-sm-3">
								<div class="logo"><a href="<?= Yii::$app->getHomeUrl() ?>"><img src="images/logo.png" alt=""></a></div>
							</div>

							<div class="col-sm-9">
								<a href="#" class="toggle-menu visible-sm-block visible-xs-block"><span></span></a>
								<nav class="header-menu clearfix">
									<?php $items = \common\models\Categorie::getForNav(); ?>
									<?= \common\widgets\OwnNav::widget([
									    'items' => $items
                                    ]) ?>
								</nav>
							</div>

						</div>
					</div>
				</div>

				<div class="header-info">
					<h1>UK's Top Gambling Sites</h1>
					<p>Grab your bonus for
                        <?= \common\helpers\CategoryList::generate($items) ?>
                    </p>
				</div>

			</header>

    <div class="container">
   
        <?= $content ?>
    </div>
</div>

	<footer>
				<div class="container">
					<div class="row">
						<div class="col-md-9 col-sm-8 col-xs-12">
							<nav class="footer-menu clearfix">
								<?= \common\widgets\FooterNav::widget() ?>
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
								<p>Design by <a href="http://perfecto-web.pro" target="_blank">Perfecto Web</a></p>
							</div>

						</div>

					</div>
				</div>
			</footer><!-- .Footer -->


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
