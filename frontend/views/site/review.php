<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use common\models\Review;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Url;

$this->title = 'Review';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row">
        <div class="bonus-blocks clearfix">
            <?php $bonuses = current($company['reviews'])['bonuses']; ?>
            <?php if (!empty($bonuses)) : ?>
                <?php $bg = 'bs-lt' ?>
                <?php foreach ($bonuses as $bonus) : ?>
                    <div class="col-md-6 col-sm-12">
                        <div class="<?= $bg ?> clearfix">
                            <div class="left">
                                <div class="tit"><?= $bonus['title'] ?></div>
                                <p><?= $bonus['description'] ?>
                                    <?php echo empty($bonus['min_deposit']) ? '<br>No Deposit Required': '';?><br>
                                    <?php echo empty($bonus['code']) ? 'No Code Needed' : 'Code:'. $bonus['code']; ?></p>
                                <div class="btn">
                                    <a href="<?= $bonus['referal_url'] ?>">
                                        <button type="button" class="btn-dft">
                                            <i class="flaticon-gift"></i>
                                            GET BONUS
                                        </button>
                                    </a>
                                </div>
                            </div>

                            <div class="right">
                                <p>Minimum Deposit<strong><?php echo empty($bonus['min_deposit']) ? '-' : '£'.$bonus['min_deposit'] ?></strong></p>
                                <p>Expiry<strong><?php echo empty($bonus['expiry']) ? '-' : $bonus['expiry'] . ' days'?></strong></p>
                                <p>Rollover Requirement<strong><?php echo empty($bonus['rollover_requirement']) ? '-' : $bonus['rollover_requirement']?></strong></p>
                                <p>Restrictions<strong><?php echo empty($bonus['restrictions']) ? '-' : $bonus['restrictions']?></strong></p>
                            </div>

                        </div>
                    </div><!-- .bs-lt -->
                    <?php $bg = 'bs-rt' ?>
                <?php endforeach; ?>
            <?php endif; ?>

        </div><!-- .bonus-blocks -->


        <?php $gallery = current($company['reviews'])['gallery']; ?>
        <?php if (!empty($gallery)) : ?>
            <div class="col-xs-12 web-screens">
                <div class="h-title"><h3>Website Screenshots</h3></div>
                <div class="ws-items photo-list">
                    <?php foreach ($gallery as $img) : ?>
                        <div class="item">
                            <a href="<?= $img['src'] ?>" data-effect="mfp-zoom-in">
                                <img src="<?= $img['src'] ?>" alt="">
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div><!-- .web-screens -->
        <?php endif; ?>
        <div class="ltr-catalog clearfix">

            <div class="col-md-9">
                <div class="side-left">
                    <div class="sl-content">
                        <?php $review = current($company['reviews']); ?>
                        <h1><?= $review['title'] ?> Review</h1>
                        <?= $review['description'] ?>
                        <div class="warning-block">
                            <i class="flaticon-deny"></i>
                            <span>EXCLUDE:</span> <?= \common\widgets\CountryPermition::widget([
                                'type' => 'denied',
                                'review_id' => $review['id']
                            ]) ?>
                        </div>

                        <div class="info-block">
                            <i class="flaticon-info"></i>
                            <span>ANY TEXT:</span> <?= \common\widgets\CountryPermition::widget([
                                'type' => 'allowed',
                                'review_id' => $review['id']
                            ]) ?>
                        </div>

                    </div>

                </div>
            </div><!-- .side-left -->

            <div class="col-md-3">
                <div class="side-right">
                    <?php $ratings = current($company['reviews'])['ratings']; ?>
                    <?php if (!empty($ratings)) : ?>
                    <div class="sr-menu">
                        <div class="srm-head">Review Rating</div>
                        <div class="srm-list srm-rating">
                            <ul>
                                <?php foreach ($ratings as $rating) : ?>
                                <li>
                                    <div class="tx"><?= $rating['title'] ?></div>
                                    <div class="bx">
                                        <div class="rt-stars">
                                            <span class="rt-inf"><?= $rating['mark'] ?>/10</span>
                                            <?php $starts = Yii::$app->starMaker->make($rating['mark']); ?>
                                            <?php foreach ($starts as $start) : ?>
                                                <span class="star flaticon-star-<?= $start ?>"></span>
                                            <?php endforeach; ?>
                                        </div> <!-- .rt-stars -->
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div><!-- .sr-menu (Review Rating) -->
                    <?php endif; ?>
                    <?php if (!empty($pros) || !empty($minuses)) : ?>
                    <div class="sr-menu">
                        <div class="srm-head">Review Summary</div>
                        <?php $pros = current($company['reviews'])['pros'] ?>
                        <?php $minuses = current($company['reviews'])['minuses'] ?>
                        <div class="srm-list srm-summary">
                            <?php foreach ($pros as $plus) : ?>
                            <p><i class="flaticon-check"></i><?= $plus['title'] ?></p>
                            <?php endforeach; ?>

                            <?php foreach ($minuses as $minus) : ?>
                                <p><i class="flaticon-close"></i><?= $minus['title'] ?></p>
                            <?php endforeach; ?>
                        </div>
                    </div><!-- .sr-menu (Review Summary) -->
                    <?php endif; ?>

                    <?php $oses = current($company['reviews'])['oses'] ?>
                    <?php if (!empty($oses)) : ?>
                    <div class="sr-menu">
                        <div class="srm-head">Compatible With</div>
                        <div class="srm-list srm-compatible">
                            <?php foreach ($oses as $os) : ?>
                                <div><i class="flaticon-os-<?= $os['title'] ?>"></i></div>
                            <?php endforeach; ?>
                        </div>
                    </div><!-- .sr-menu (Compatible With) -->
                    <?php endif; ?>

                    <?php $dep_methods = current($company['reviews'])['deposits'] ?>
                    <?php if (!empty($dep_methods)) : ?>
                    <div class="sr-menu">
                        <div class="srm-head">Deposit Methods</div>
                        <div class="srm-list srm-dmethods clearfix">
                            <?php foreach ($dep_methods as $method) : ?>
                            <a class="item" href="#" target="_blank" style="
                            background-image: url(..<?= $method['logo'] ?>);
                            background-repeat: no-repeat;
                            background-position: center center;"
                            >&nbsp;</a>
                            <?php endforeach; ?>
                        </div>
                    </div><!-- .sr-menu (Deposit Methods) -->
                    <?php endif; ?>

                    <?php if (!empty($review['address'])) : ?>
                    <div class="sr-menu srm-contact">
                        <div class="srm-head">Contact Details</div>
                        <div class="srm-list">
                            <address>
                                <?= $review['address'] ?>
                            </address>

                        </div>
                    </div><!-- .sr-menu (Contact Details) -->
                    <?php endif; ?>

                    <?php $reviews = Review::getTop($review['category']['id'], $review['id']); ?>
                    <?php if (!empty($reviews)) : ?>
                    <div class="sr-menu">
                        <div class="srm-head">Alternative <?= $review['category']['title'] ?> Websites</div>
                        <div class="srm-list srm-pwebsites">
                            <ul>
                                <?php foreach ($reviews as $review) : ?>
                                    <li><a href="<?= Url::to(['site/review', 'id' => $review['id']]) ?>" target="_blank"><?= $review['title'] ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div><!-- .sr-menu (Contact Details) -->
                    <?php endif; ?>
                </div>
            </div><!-- .side-right -->

        </div><!-- .ltr-catalog -->

    </div>
</div>
<div class="claim-block">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="tit">Like <?= $review['title'] ?> ?</div>
                <p>Claim your <?= $review['title'] ?> Bonus Today!</p>
                <div class="btn">
                    <a href="<?= $this->params['company']['url'] ?>">
                        <button type="button" class="btn-dft">Claim now</button>
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="websites-block">
    <div class="container">
        <?php $related_reviews = \common\models\Company::getRelatedReviews($company['id'], current($company['reviews'])['id'])['reviews'] ?>

        <?php foreach ($related_reviews as $review) : ?>
        <div class="row">
            <div class="item">
                <div class="tit"><a href="<?= Url::to(['site/review', 'id' => $review['id']]) ?>"><?= $review['title'] ?></a>
                    <?php $bonus = current($review['bonuses']); ?>
                    <p><?= $bonus['description'] ?>: <strong> £<?= $bonus['min_deposit'] ?></strong></p>
                </div>
                <div class="img"><img src="<?= $review['preview'] ?>" alt=""></div>
                <div class="inf"><?= $review['preview_title'] ?></div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>