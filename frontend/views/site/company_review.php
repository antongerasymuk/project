<?php
$this->title = $review->title;
$this->params['breadcrumbs'][] = $this->title;
use \common\models\Review;
use \yii\helpers\Url;
?>
<div class="container">
    <div class="row">
        <?php $companyReviews = $review->company->getReviews()
                              ->where(['type' => Review::REVIEW_TYPE])
                              ->all()
        ?>
        <?php if (!empty($companyReviews)) : ?>
        <div class="customer-offers-block clearfix">
            <div class="tit"><?= $review->company->title ?> New Customer Offers</div>
            <div class="items col-xs-12">
                <?php foreach ($companyReviews as $companyReview) : ?>
                <div class="item">
                    <div class="img"><img src="<?= $companyReview->logo ?>" alt=""></div>
                    <div class="i-tit">
                        <a href="<?= Url::to(['site/review', 'id' => $companyReview->id]) ?>">
                            <?= $companyReview->title ?> Review
                        </a>
                    </div>
                </div><!-- .item -->
                <?php endforeach; ?>
            </div>
        </div><!-- .customer-offers-block -->
        <?php endif; ?>
        <div class="ltr-catalog clearfix">

            <div class="col-md-9">
                <div class="side-left">
                    <div class="sl-content">
                        <h1><?= $review->title ?> Review</h1>
                        <?= $review->description ?>
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

                    <?php if (!empty($review->company->licenses)) : ?>
                        <?php foreach ($review->company->licenses as $lic) : ?>
                            <div class="sr-menu">
                                <div class="srm-head"><?= $lic->title ?></div>
                                <div class="srm-list srm-docs">
                                    <p>
                                        <i class="flaticon-docs"></i>
                                        <a href="<?= $lic->url ?>"><?= $lic->file_label ?></a>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
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

                    <?php if (!empty($review->company->director)) : ?>
                        <div class="sr-menu">
                            <div class="srm-head"><?= $review->company->director->title ?></div>
                            <div class="srm-list srm-ceo clearfix">
                                <p>
                                    <img class="img-left" src="<?= $review->company->director->photo ?>" alt="">
                                    <?= $review->company->director->description ?>
                                </p>
                            </div>
                        </div>
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

                    <?php $topCompanies = \common\models\Company::find()
                        ->orderBy('rating')
                        ->where(['<>', 'id', $review->company->id])
                        ->all(); ?>
                    <?php if (!empty($topCompanies)) : ?>
                        <div class="sr-menu">
                            <div class="srm-head">Alternative Companies Websites</div>
                            <div class="srm-list srm-pwebsites">
                                <ul>
                                    <?php foreach ($topCompanies as $topCompany) : ?>
                                        <?php $companyReview = $topCompany->getReviews()
                                            ->where(['type' => Review::COMPANY_TYPE])
                                            ->one()
                                        ?>
                                        <?php if (!empty($companyReview)) : ?>
                                        <li>
                                            <a href="<?= Url::to(['site/review', 'id' => $companyReview->id]) ?>" target="_blank">
                                                <?= $companyReview->title ?>
                                            </a>
                                        </li>
                                        <?php endif; ?>
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

<?php $relatedReviews = $review->getRelated(3); ?>

<?php if (!empty($relatedReviews)) : ?>
    <div class="websites-block">
        <div class="container">
            <div class="row">
                <?php foreach ($relatedReviews as $relatedReview) : ?>
                    <div class="item">
                        <div class="tit"><a href="#"><?= $relatedReview->title ?></a>
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