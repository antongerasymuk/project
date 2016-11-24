<?php
/**
 * @var $review \common\models\Review
 * @var $bonus \common\models\Bonus
 * @var $bonuses array
 * @var $image \common\models\Gallery
 * @var $rating \common\models\Rating
 * @var $plus \common\models\Plus
 */
use yii\helpers\Url;
$this->title = $review->title;
$this->params['breadcrumbs'][] = [
    'url' => ['site/category', 'id' => $review->category->id],
    'label' => $review->position ?   $review->position : $review->category->title . ' Sites'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row">
        <?php if (!empty($review->bonuses)) : ?>
        <div class="bonus-blocks clearfix">
            <?php $bonusClass = 'bs-lt';?>
            <?php $bonusOneClass = ''; ?>
             <?php if (count($review->bonuses) == 1) 
            {
                $bonusOneClass = 'one_item';
                $bonusClass = 'bs-rt';
            }
            ?>
            <?php foreach ($review->bonuses as $bonus) : ?>
                <div class="col-md-6 col-sm-12 <?= $bonusOneClass ?>">
                <div class="<?= $bonusClass ?> clearfix">
                    <div class="left">
                        <div class="tit"><?= $bonus->title ?></div>
                        <p><?= $bonus->description ?></p>
                        <div class="btn">
                            <a href="<?= $bonus->referal_url ?>">
                                <button type="button" class="btn-dft"><i class="flaticon-gift"></i> GET BONUS</button>
                            </a>
                        </div>
                    </div>
                    <div class="right">
                        <?php $min_deposit = empty($bonus->min_deposit) ? '-' : $bonus->currency . $bonus->min_deposit ?>
                        <p>Minimum Deposit<strong><?= $min_deposit ?></strong></p>
                        <p>Expiry<strong><?= $bonus->expiry ?>&nbsp;days</strong></p>
                        <?php $rollover_title = empty($bonus->rollover_title) ? 'Rollover Requirement' : $bonus->rollover_title ?>
                        <p><?= $rollover_title ?><strong><?= $bonus->rollover_requirement ?></strong></p>
                        <p>Restrictions<strong><?= $bonus->restrictions ?></strong></p>
                    </div>

                </div>
            </div><!-- .bs-lt -->
            <?php $bonusClass = 'bs-rt'; ?>
            <?php endforeach; ?>

        </div><!-- .bonus-blocks -->
        <?php endif; ?>

        <?php if (!empty($review->galleries)) : ?>
        <div class="col-xs-12 web-screens">
            <div class="h-title"><h3>Website Screenshots</h3></div>

            <div class="ws-items photo-list">
                <?php foreach ($review->galleries as $image) : ?>
                <div class="item">
                    <a href="<?= $image->src; ?>" data-effect="mfp-zoom-in">
                        <img src="<?= $image->src; ?>" alt=""/>
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
                        <h1><?= $review->title ?> Review</h1>
                        <?= $review->description ?>
                        <?php if (!empty($review->allowed)) : ?>
                        <div class="warning-block">
                            <i class="flaticon-deny"></i> <span>EXCLUDE:</span>
                            <?= \common\widgets\CountryPermition::widget([
                                'model' => $review,
                                'type' => 'allowed'
                            ]) ?>
                        </div>
                        <?php endif; ?>

                        <?php if (!empty($review->denied)) : ?>
                        <div class="info-block">
                            <i class="flaticon-info"></i> <span>ANY TEXT:</span>
                            <?= \common\widgets\CountryPermition::widget([
                                'model' => $review,
                                'type' => 'denied'
                            ]) ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div><!-- .side-left -->

            <div class="col-md-3">
                <div class="side-right">
                    <?php if (!empty($review->ratings)) : ?>
                        <div class="sr-menu">
                        <div class="srm-head">Review Rating</div>
                        <div class="srm-list srm-rating">
                            <ul>
                                <?php foreach ($review->ratings as $rating) : ?>
                                <li>
                                    <div class="tx"><?= $rating->title ?></div>
                                    <div class="bx">
                                        <div class="rt-stars">
                                            <span class="rt-inf"><?= $rating->mark ?>/10</span>
                                            <?= Yii::$app->starMaker->generate($rating->mark) ?>
                                        </div> <!-- .rt-stars -->
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>

                        </div>
                    </div><!-- .sr-menu (Review Rating) -->
                    <?php endif; ?>
                    <?php if (!empty($review->pluses)) : ?>
                    <div class="sr-menu">
                        <div class="srm-head">Review Summary</div>
                        <div class="srm-list srm-summary">
                            <?php foreach ($review->pluses as $plus) : ?>
                                <p><i class="flaticon-check"></i><?= $plus->title ?></p>
                            <?php endforeach; ?>

                            <?php if (!empty($review->minuses)) : ?>
                                <?php foreach ($review->minuses as $minus) : ?>
                                    <p><i class="flaticon-close"></i><?= $minus->title ?></p>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div><!-- .sr-menu (Review Summary) -->
                    <?php endif; ?>

                    <?php if (!empty($review->oses)) : ?>
                    <div class="sr-menu">
                        <div class="srm-head">Compatible With</div>
                        <div class="srm-list srm-compatible">
                            <?php foreach ($review->oses as $os) : ?>
                                <div><i class="flaticon-os-<?= strtolower($os->title) ?>"></i></div>
                            <?php endforeach; ?>
                        </div>
                    </div><!-- .sr-menu (Compatible With) -->
                    <?php endif; ?>

                    <?php if (!empty($review->deposits)) : ?>
                    <div class="sr-menu">
                        <div class="srm-head">Deposit Methods</div>
                        <div class="srm-list srm-dmethods clearfix">
                            <?php foreach ($review->deposits as $deposit) : ?>
                                <a class="item " style="
                                background-image: url(<?= $deposit->logo ?>);
                                background-repeat: no-repeat;
                                background-position: center center;" href="#" target="_blank">&nbsp;</a>
                            <?php endforeach; ?>
                        </div>
                    </div><!-- .sr-menu (Deposit Methods) -->
                    <?php endif; ?>

                    <?php if (!empty($review->address)) : ?>
                    <div class="sr-menu srm-contact">
                        <div class="srm-head">Contact Details</div>
                        <div class="srm-list">
                            <address><?= $review->address ?></address>
                        </div>
                    </div><!-- .sr-menu (Contact Details) -->
                    <?php endif; ?>

                    <?php $topReviews = $review->getTop(); ?>
                    <?php if (!empty($topReviews)) : ?>
                    <div class="sr-menu">
                        <div class="srm-head">Alternative <?= $review->category->title ?> Websites</div>
                        <div class="srm-list srm-pwebsites">
                            <ul>
                                <?php foreach ($topReviews as $topReview) : ?>
                                    <li>
                                        <a href="<?= Url::to(['site/review', 'id' => $topReview['id']]) ?>" target="_blank"><?= $topReview['title'] ?></a>
                                    </li>
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
                <div class="tit">Like <?= $review->title ?> ?</div>
                <p>Claim your <?= $review->title ?> Bonus Today!</p>
                <div class="btn">
                    <a href="<?= $review->company->site_url ?>">
                        <button type="button" class="btn-dft">Claim now</button>
                    </a>
                </div>
            </div>

        </div>
    </div>
</div> <!-- .claim-block -->

<?php $relatedReviews = $review->getRelated(); ?>

<?php if (!empty($relatedReviews)) : ?>
    <div class="websites-block">
        <div class="container">
            <div class="row">
                <?php foreach ($relatedReviews as $relatedReview) : ?>
                    <div class="item">
                        <div class="tit"><a href="<?= Url::to([
                                'site/review',
                                'id' => $relatedReview->id
                            ]) ?>"><?= $relatedReview->title ?></a>
                            <p><?= $review->getMainBonus()->description ?></p>
                        </div>
                        <div class="img"><img src="<?= $relatedReview->preview ?>" alt=""></div>
                        <div class="inf"><?= $relatedReview->preview_title ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div><!-- .websites-block -->
<?php endif; ?>
