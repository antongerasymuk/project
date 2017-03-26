<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'css/grid.css',
        //'css/style.min.css'

        'http://d3nzdclrsrj0jr.cloudfront.net/compressed_styles_v_2.css'
    ];
    public $js = [
        
        //'js/jquery-2.1.1.min.js',
        //'js/riot_mount.js',

        //'https://s3.eu-central-1.amazonaws.com/bonusonlinebucket/2b88a946dbabe9ae5c3d2268e906a112.js',
        //'https://s3.eu-central-1.amazonaws.com/bonusonlinebucket/08c0f3b2114523bd258b501499d5a1bd.js',
        //'https://s3.eu-central-1.amazonaws.com/bonusonlinebucket/akjxcvg.js',
        //'https://s3.eu-central-1.amazonaws.com/bonusonlinebucket/bvdsdfwefwe.js',
        //'http://d3nzdclrsrj0jr.cloudfront.net/e77904a7118434174efb810549f6caf3.js',

         //'https://d3nzdclrsrj0jr.cloudfront.net/bonusonlinebucket/e77911.js',
         //'https://d3nzdclrsrj0jr.cloudfront.net/bonusonlinebucket/e77918.js',

        //'http://d3nzdclrsrj0jr.cloudfront.net/2b88a946dbabe9ae5c3d2268e906a112.js',
        //'http://d3nzdclrsrj0jr.cloudfront.net/08c0f3b2114523bd258b501499d5a1bd.js',
        //'http://d3nzdclrsrj0jr.cloudfront.net/09118f0b34d8f2dcfb4fcde33683edcb.js',
        //'http://d3nzdclrsrj0jr.cloudfront.net/cc847f68fea354be28f898be24b5cf84.js',

        'http://d3nzdclrsrj0jr.cloudfront.net/compressed_v_7.js'

        /*'js/uncompress/riot.min.js',
        'js/uncompress/compatible_with.js',
        'js/uncompress/common.js',
        'js/uncompress/company_offer.js',
        'js/uncompress/bookmaker_bonus.js',
        'js/uncompress/raw.js',
        'js/uncompress/rating_by_stars.js',
        'js/uncompress/oboe-browser.min.js',
        'js/uncompress/companies_list.js',

        'js/uncompress/bonus_filter.js',

        'js/uncompress/bonuses_list.js',
        'js/uncompress/bookmaker_bonuses_list.js',
        'js/uncompress/filter.js',*/
        


        //'js/riot.min.js',
        //'js/compatible_with.js',
        //'js/common.js',
        //'js/company_offer.js',
        //'js/bookmaker_bonus.js',
        //'js/raw.js',
        //'js/rating_by_stars.js',
        //'js/oboe-browser.min.js',

    ];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
