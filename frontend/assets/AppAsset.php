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

        'http://d3nzdclrsrj0jr.cloudfront.net/a62671a807877f6c5dd73436936e67a1.css'
    ];
    public $js = [
        
        //'js/jquery-2.1.1.min.js',
        //'js/riot_mount.js',

        //'https://s3.eu-central-1.amazonaws.com/bonusonlinebucket/2b88a946dbabe9ae5c3d2268e906a112.js',

        //'http://d3nzdclrsrj0jr.cloudfront.net/2b88a946dbabe9ae5c3d2268e906a112.js',
        //'http://d3nzdclrsrj0jr.cloudfront.net/08c0f3b2114523bd258b501499d5a1bd.js',
        //'http://d3nzdclrsrj0jr.cloudfront.net/09118f0b34d8f2dcfb4fcde33683edcb.js',
        //'http://d3nzdclrsrj0jr.cloudfront.net/cc847f68fea354be28f898be24b5cf84.js',
        
        'js/riot.min.js',
        'js/compatible_with.js',
        'js/common.js',
        'js/company_offer.js',
        'js/bookmaker_bonus.js',
        'js/raw.js',
        'js/rating_by_stars.js',
        'js/oboe-browser.min.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
