<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use \common\helpers\CategoryList;
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
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrapper">
    <header class="whill">
        <div class="header-top">
            <div class="container">
                <div class="row">

                    <div class="col-sm-3">
                        <div class="logo"><a href="<?= Yii::$app->homeUrl ?>"><img src="/images/logo.png" alt=""></a></div>
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

        <div class="header-lg">
            <a target="_blank" href="<?= $this->params['company']['url'] ?>">
                <img src="<?= $this->params['logo'] ?>" alt="">
            </a>
            <?php if (isset($this->params['is_company'])) : ?>

                <p>
                    Grab your bonus for 
                    <?php 
                  
                    $relatedReviews = $this->params['review']->getReviews();
                    $length = count($relatedReviews);
                    ?>
                    <?php foreach ($relatedReviews as $key => $relatedReview) : ?>
                    <a href="<?= Url::to([
                                'site/review',
                                'id' => $relatedReview->id
                            ]) ?>"><?= $relatedReview->category->title ?>
                                   <?php if($key != $length-1): ?>
                                    ,
                                   <?php endif; ?>
                    </a>

                    <?php endforeach; ?>
                </p>
            <?php endif; ?>
        </div>

        <div class="container">
            <div class="visit-btn">
                <a href="<?= $this->params['company']['url'] ?>">
                    Visit <?= $this->params['company']['name'] ?>
                    <i class="flaticon-arr-right"></i>
                </a>
            </div>
        </div>

    </header><!-- .Header -->
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
                        <div class="share-block">
                            <a href="#" class="shareBl s-tw"> <i class="flaticon-soc-tw"></i> <span>Share</span></a>
                            <a href="#" class="shareBl s-fb"> <i class="flaticon-soc-fb"></i> <span>Share</span></a>
                            <a href="#" class="shareBl s-gp"> <i class="flaticon-soc-gp"></i> <span>Share</span></a>
                        </div>
                    </div><!-- .share-block -->
                </div>
            </div>

        </div><!-- .main-top -->
        <?= Alert::widget() ?>
        <?= $content ?>
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
                    It is your responsibility to verify and examine all aspects of your bonus. Please read the terms and conditions carefully.<br/>
                    We provide no guarantee as to the timeliness or accuracy of the information found on this site.
                </div>

                <div class="copyright hidden-xs">
                    <p>Copyright © 2016 <span>bestonlinebonuses.co.uk</span>. All Rights Reserved</p>
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
                    <p>Copyright © 2016 <span>bestonlinebonuses.co.uk</span>. All Rights Reserved</p>
                </div>

            </div>
        </div>
    </div>
</footer><!-- .Footer -->
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
