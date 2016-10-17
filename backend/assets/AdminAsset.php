<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AdminAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
        'css/backend.min.css',
		'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext'
	];
	public $js = [
		'js/jquery-migrate-1.0.0.min.js',
		'js/jquery-ui-1.10.0.custom.min.js',
        'js/jquery.ui.touch-punch.min.js',
        'js/bootstrap.min.js',
		'js/jquery.dataTables.min.js',
		'js/jquery.chosen.min.js',
		'js/jquery.uniform.min.js',
		'js/jquery.cleditor.min.js',
		'js/jquery.elfinder.min.js',
		'js/jquery.uploadify-3.1.min.js',
        'js/custom.min.js',
        'js/stan.custom.min.js'
	];
	public $depends = [
		'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'backend\assets\SwaltAsset'
	];
}
