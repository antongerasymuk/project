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
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <?= \common\helpers\AddGTM::generate('head', '5CZTR4F') ?>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?//= Html::encode($this->title) ?><?
		$for_title = '';
		if (isset($this->metaTags)):
		foreach ($this->metaTags as $onemetatag) {
			if (mb_strpos($onemetatag, 'name="title"')) {
				$arTagParts = explode('"', $onemetatag);
				$for_title = $arTagParts[count($arTagParts)-2];
			}
		}
		endif;
		if ($for_title) {
			echo $for_title;
		} else {
			$arTitleParts = explode(' ', Html::encode($this->title));
			if ($arTitleParts[count($arTitleParts)-1] == 'Sites') {
				unset($arTitleParts[count($arTitleParts)-1]);
				echo implode(' ',$arTitleParts);
			}
		}
	?></title>
    <?php $this->head() ?>
</head>
<body>
<?= \common\helpers\AddGTM::generate('body', '5CZTR4F') ?>
<?php $this->beginBody() ?>

<div class="wrap">
    <header>
        <div class="header-top">
            <div class="container">
                <div class="row">

                    <div class="col-sm-3">
                        <div class="logo"><a href="<?= Yii::$app->getHomeUrl() ?>"><img src="<?= $this->params['cdnHost'].'/images/logo.png' ?>"
                                                                                        alt=""></a></div>
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

                </div>
            </div>

        </div><!-- .main-top -->
        <div class="container">
            <?= $content ?>
        </div>
</div>
</main>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-8 col-xs-12">
                <nav class="footer-menu clearfix">
                    
                 <?php if(isset(\common\models\Site::getForOther()['footer'])) { echo \common\widgets\FooterNav::widget([
									'items' => \common\models\Site::getForOther()['footer']
									]);} ?>
                </nav>


                <div class="footer-info">
                    It is your responsibility to verify and examine all aspects of your bonus. Please read the terms and
                    conditions carefully.<br/>
                    We provide no guarantee as to the timeliness or accuracy of the information found on this site.
                </div>

                <div class="copyright hidden-xs">
                    <p>Copyright © 2017 <span>bestonlinebonuses.uk</span>. All Rights Reserved</p>
                </div>

            </div>

            <div class="col-md-3 col-sm-4 col-xs-12 clearfix pdl0 ftx">
                <div class="b-opened">
                    <div class="cnt"><?= file_get_contents(Url::toRoute(['bonus/number', 'mode' => 'get', 'v' => time()],true)) ?></div>
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
                    <p>Copyright © 2017 <span>bestonlinebonuses.uk</span>. All Rights Reserved</p>
                </div>

            </div>

        </div>
    </div>
</footer><!-- .Footer -->


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
