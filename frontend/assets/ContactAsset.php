<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class ContactAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'css/grid.css',
        //'css/style.min.css'

        'http://d3nzdclrsrj0jr.cloudfront.net/compressed_styles_v_2.css'
    ];
    public $js = [
       
        
       

    ];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
