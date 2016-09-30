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
        'css/grid.css',
        'css/style.min.css'
    ];
    public $js = [
        'js/riot.min.js',
        'js/jquery-2.1.1.min.js',
         //'js/riot_mount.js',
         'js/compatible_with.js',
        'js/common.js',
        'js/company_offer.js',
        'js/companies_list_data.js',
        'js/bonuses_list_data.js',
        'js/raw.js',
        'js/rating_by_stars.js',
        'js/oboe-browser.min.js',
        'js/oboe_index.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
