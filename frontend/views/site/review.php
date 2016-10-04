<?php
/**
 * @var $review \common\models\Review
 * @var $bonus \common\models\Bonus
 * @var $bonuses array
 * @var $image \common\models\Gallery
 */
?>
<?php //var_dump($review->bonuses) ?>
<div class="container">
    <div class="row">
        <?php if (!empty($review->bonuses)) : ?>
        <div class="bonus-blocks clearfix">
            <?php foreach ($review->bonuses as $bonus) : ?>
            <div class="col-md-6 col-sm-12">
                <div class="bs-lt clearfix">
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
                        <p>Minimum Deposit<strong><?= $bonus->min_deposit ?></strong></p>
                        <p>Expiry<strong><?= $bonus->expiry ?></strong></p>
                        <p>Rollover Requirement<strong><?= $bonus->rollover_requirement ?></strong></p>
                        <p>Restrictions<strong><?= $bonus->restrictions ?></strong></p>
                    </div>

                </div>
            </div><!-- .bs-lt -->
            <?php endforeach; ?>

        </div><!-- .bonus-blocks -->
        <?php endif; ?>

        <?php if (!empty($review->gallery)) : ?>
        <div class="col-xs-12 web-screens">
            <div class="h-title"><h3>Website Screenshots</h3></div>

            <div class="ws-items photo-list">
                <?php foreach ($review->gallery as $image) : ?>
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
                        <h1>William Hill Casino Review</h1>
                        <p>Since its launch in 2000, William Hill Casino has established itself as one of the top
                            destinations for players around the UK. The company has the financial backing and
                            operational experience to provide the latest games and more substantial new customer offers
                            than most rivals (follow the link to compare). With over 150 titles available including
                            progressive jackpots, live tables and mobile apps, plus some generous sign up offers, this
                            site seems to have covered all the bases.<br/>
                            Fair play and security are guaranteed by the terms of their operating licence, issued in
                            Gibraltar.</p>

                        <h2>Bonus Codes and Promotions</h2>
                        <hr>
                        <p>To welcome new players, bonuses and codes are available, paid in the form of credits, which
                            can be used to play the games. The bonus money must be wagered several times before a
                            withdrawal can be requested. This prevents anyone from claiming the funds and then
                            withdrawing them without actually playing.</p>
                        <p>Regulars are eligible to get extra bonuses which vary each month, but can include a monthly
                            loyalty bonus for each deposit you make, while the Comp Points scheme means that you earn
                            points every time you place a wager, which can then be converted to free casino money or
                            merchandise. There is a VIP club, which gives frequent players a better Comp Points
                            conversion rate as well as higher table limits, exclusive tournaments, invites to VIP events
                            and even a personal account manager. Other regular promotions include competitions, double
                            points and a £50 bonus when you refer a friend who subsequently joins up.</p>

                        <h2>Games</h2>
                        <hr>
                        <p>William Hill uses Playtech software, which means that they have a good range of online games.
                            A particular feature of Playtech slots is the number of film and TV show based games, making
                            this range an essential choice for movie and popular culture fans. Among the most widely
                            played titles are slots based on:</p>
                        <ul class="list-disc">
                            <li>Gladiator</li>
                            <li>Rocky</li>
                            <li>King Kong</li>
                            <li>The Six Million Dollar Man</li>
                            <li>The Pink Panther</li>
                            <li>Iron Man</li>
                            <li>The Hulk</li>
                            <li>Ghost Rider</li>
                        </ul>
                        <p>Progressive slots can have jackpots of well over $1,000,000, with Beach Life having the
                            biggest prize and Gladiator not far behind. Roulette players will be spoilt for choice with
                            twelve versions, Blackjack is available in seven varieties and there are lots of poker
                            varieties to play as well. On top of these, the live casino offers Roulette, Blackjack,
                            Baccarat and Holdem, and is the closest you can get to the full casino experience, without
                            leaving home.<br/>
                            When you are away from home, you can still play a selection of the most popular games using
                            the free mobile app, which is compatible with all Android and Apple devices. A useful
                            feature of this app is that you can deposit funds and even open a new account via a mobile
                            or tablet.</p>

                        <h2>Banking</h2>
                        <hr>
                        <p>Few online casinos let you pay in using such a wide range of options and no fees are charged
                            for deposits. Not all options are available in all territories, but there is a handy drop
                            down menu in the Banking area which will inform you about which methods are open to
                            you.<br/>
                            Withdrawing funds is simply a matter of entering your username and password and requesting
                            the money. The first time you request a withdrawal, you will get a verification code sent to
                            you, which is a fraud prevention measure. Withdrawal requests are handled exceptionally
                            quickly and securely, with processing carried out on the first business day, and all
                            transactions carried out over 128 bit SSL servers. Once you have an account at William Hill,
                            you can use the same details and deposited money to bet on sports, bingo, live casino,
                            poker, and financials, as well as the mobile equivalents.</p>

                        <h2>Conclusion</h2>
                        <hr>
                        <p>William Hill has established itself as one of the top online casinos in the UK. The range of
                            quality games is good and bonuses, particularly ongoing offers, are competitive. Benefits
                            include the ability to use one account across a number of sites and William Hill are very
                            quick to return winnings to your account when you request a withdrawal.</p>

                        <div class="warning-block"><i class="flaticon-deny"></i> <span>EXCLUDE:</span> Afghanistan,
                            American Samoa, Bermuda, Bulgaria, China, Congo The Democratic Republic, Democratic Peoples
                            Republic of Korea, Denmark, France, France, Metropolitan, French Guiana, French Polynesia,
                            French Southern Territories, Greece, Grenada, Guadeloupe, Guam, Haiti, India, Iran, Iraq,
                            Israel, Italy, Myanmar, New Caledonia, Northern Mariana Islands, Pakistan, Puerto Rico,
                            Portugal, Republic of Sudan, Reunion, Romania, Rwanda, Samoa, Sierra Leone, Singapore,
                            Slovenia, Spain, St Barthelemy, St Martin, Syrian Arab Republic, Turkey, Ukraine, United
                            States Minor Outlying Islands, United States of America, Virgin Islands (U.S.)
                        </div>

                        <div class="info-block">
                            <i class="flaticon-info"></i> <span>ANY TEXT:</span> Afghanistan, American Samoa, Bermuda,
                            Bulgaria, China, Congo The Democratic Republic, Democratic Peoples Republic of Korea,
                            Denmark, France, France, Metropolitan, French Guiana, French Polynesia, French Southern
                            Territories, Greece, Grenada, Guadeloupe, Guam, Haiti, India, Iran, Iraq, Israel, Italy,
                            Myanmar, New Caledonia, Northern Mariana Islands, Pakistan, Puerto Rico, Portugal, Republic
                            of Sudan, Reunion, Romania, Rwanda, Samoa, Sierra Leone, Singapore, Slovenia, Spain, St
                            Barthelemy, St Martin, Syrian Arab Republic, Turkey, Ukraine, United States Minor Outlying
                            Islands, United States of America, Virgin Islands (U.S.)
                        </div>

                    </div>

                </div>
            </div><!-- .side-left -->

            <div class="col-md-3">
                <div class="side-right">

                    <div class="sr-menu">
                        <div class="srm-head">Review Rating</div>
                        <div class="srm-list srm-rating">

                            <ul>
                                <li>
                                    <div class="tx">Reputation</div>
                                    <div class="bx">
                                        <div class="rt-stars">
                                            <span class="rt-inf">9/10</span>
                                            <span class="star flaticon-star-full"></span>
                                            <span class="star flaticon-star-full"></span>
                                            <span class="star flaticon-star-full"></span>
                                            <span class="star flaticon-star-full"></span>
                                            <span class="star flaticon-star-half"></span>
                                        </div> <!-- .rt-stars -->
                                    </div>
                                </li>
                                <li>
                                    <div class="tx">Software</div>
                                    <div class="bx">
                                        <div class="rt-stars">
                                            <span class="rt-inf">8/10</span>
                                            <span class="star flaticon-star-full"></span>
                                            <span class="star flaticon-star-full"></span>
                                            <span class="star flaticon-star-full"></span>
                                            <span class="star flaticon-star-empty"></span>
                                            <span class="star flaticon-star-empty"></span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="tx">Promotions</div>
                                    <div class="bx">
                                        <div class="rt-stars">
                                            <span class="rt-inf">9/10</span>
                                            <span class="star flaticon-star-full"></span>
                                            <span class="star flaticon-star-full"></span>
                                            <span class="star flaticon-star-full"></span>
                                            <span class="star flaticon-star-full"></span>
                                            <span class="star flaticon-star-half"></span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="tx">Support</div>
                                    <div class="bx">
                                        <div class="rt-stars">
                                            <span class="rt-inf">7.5/10</span>
                                            <span class="star flaticon-star-full"></span>
                                            <span class="star flaticon-star-full"></span>
                                            <span class="star flaticon-star-full"></span>
                                            <span class="star flaticon-star-half"></span>
                                            <span class="star flaticon-star-empty"></span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="tx">Withdrawals speed</div>
                                    <div class="bx">
                                        <div class="rt-stars">
                                            <span class="rt-inf">9/10</span>
                                            <span class="star flaticon-star-full"></span>
                                            <span class="star flaticon-star-full"></span>
                                            <span class="star flaticon-star-full"></span>
                                            <span class="star flaticon-star-full"></span>
                                            <span class="star flaticon-star-half"></span>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                        </div>
                    </div><!-- .sr-menu (Review Rating) -->

                    <div class="sr-menu">
                        <div class="srm-head">Review Summary</div>
                        <div class="srm-list srm-summary">
                            <p><i class="flaticon-check"></i>Good range of tables and slots.</p>
                            <p><i class="flaticon-check"></i>Large deposit bonus promotions.</p>
                            <p><i class="flaticon-check"></i>Concise design.</p>
                            <p><i class="flaticon-close"></i>Confusing domain structure and branding.</p>
                        </div>
                    </div><!-- .sr-menu (Review Summary) -->

                    <div class="sr-menu">
                        <div class="srm-head">Compatible With</div>
                        <div class="srm-list srm-compatible">
                            <div><i class="flaticon-os-mac"></i></div>
                            <div><i class="flaticon-os-android"></i></div>
                            <div><i class="flaticon-os-windows"></i></div>
                        </div>
                    </div><!-- .sr-menu (Compatible With) -->

                    <div class="sr-menu">
                        <div class="srm-head">Deposit Methods</div>
                        <div class="srm-list srm-dmethods clearfix">
                            <a class="item mc" href="#" target="_blank">&nbsp;</a>
                            <a class="item visa" href="#" target="_blank">&nbsp;</a>
                            <a class="item paypal" href="#" target="_blank">&nbsp;</a>
                            <a class="item maestro" href="#" target="_blank">&nbsp;</a>
                            <a class="item visa-debit" href="#" target="_blank">&nbsp;</a>
                        </div>
                    </div><!-- .sr-menu (Deposit Methods) -->

                    <div class="sr-menu srm-contact">
                        <div class="srm-head">Contact Details</div>
                        <div class="srm-list">
                            <address>
                                <p><strong>William Hill</strong><br/> Greenside House<br/> Wood Green<br/> London<br/>
                                    N22 7TP<br/> United Kingdom</p>
                                <p><strong>Customer Services:</strong><br/> <a href="tel:0800 014 9469">0800 014
                                        9469</a></p>
                                <p><strong>Support Email:</strong><br/> <a class="text-underline"
                                                                           href="mailto:casino@willhill.com">casino@willhill.com</a>
                                </p>
                            </address>

                        </div>
                    </div><!-- .sr-menu (Contact Details) -->

                    <div class="sr-menu">
                        <div class="srm-head">Alternative Poker Websites</div>
                        <div class="srm-list srm-pwebsites">
                            <ul>
                                <li><a href="#" target="_blank">Ladbrokes Casino</a></li>
                                <li><a href="#" target="_blank">Sky Casino</a></li>
                                <li><a href="#" target="_blank">Super Casino</a></li>
                                <li><a href="#" target="_blank">Gala Casino</a></li>
                                <li><a href="#" target="_blank">32Red Casino</a></li>
                            </ul>
                        </div>
                    </div><!-- .sr-menu (Contact Details) -->

                </div>
            </div><!-- .side-right -->

        </div><!-- .ltr-catalog -->

    </div>
</div>

<div class="claim-block">
    <div class="container">
        <div class="row">

            <div class="col-xs-12">
                <div class="tit">Like William Hill Casino ?</div>
                <p>Claim your William Hill Casino Bonus Today!</p>
                <div class="btn">
                    <button type="button" class="btn-dft">Claim now</button>
                </div>
            </div>

        </div>
    </div>
</div> <!-- .claim-block -->

<div class="websites-block">
    <div class="container">
        <div class="row">

            <div class="item">
                <div class="tit"><a href="#">William Hill Free Bet</a>
                    <p>100% Deposit Bonus: <strong>£25</strong></p></div>
                <div class="img"><img src="images/screen-5.jpg" alt=""></div>
                <div class="inf">Bet live or at any time on one of the many markets.</div>
            </div>

            <div class="item">
                <div class="tit"><a href="#">William Hill Bingo</a>
                    <p>Just Deposit £10: <strong>£50</strong></p></div>
                <div class="img"><img src="images/screen-6.jpg" alt=""></div>
                <div class="inf">One of the most visited bingo sites.</div>
            </div>

            <div class="item">
                <div class="tit"><a href="#">William Hill Poker</a>
                    <p>100% Deposit Bonus: <strong>£1200</strong></p></div>
                <div class="img"><img src="images/screen-7.jpg" alt=""></div>
                <div class="inf">Fantastic prizes and huge bonuses available.</div>
            </div>

        </div>
    </div>
</div><!-- .websites-block -->