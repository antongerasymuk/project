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
        'js/common.js',
        'js/company_offer.js',
        'js/companies_list_data.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
