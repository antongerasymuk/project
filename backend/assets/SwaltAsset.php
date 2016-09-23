<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class SwaltAsset extends AssetBundle
{
    public $sourcePath = '@bower/sweetalert/dist';
    public $css = [
        'sweetalert.css'
    ];
    public $js = [
        'sweetalert.min.js'
    ];
}
