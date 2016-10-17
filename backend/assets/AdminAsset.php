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
//		'css/bootstrap.min.css',
		'css/bootstrap-responsive.min.css',
		'css/style.css',
		'css/style-responsive.css',
		'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext'
	];
	public $js = [
//		'js/jquery-1.9.1.min.js',
		'js/jquery-migrate-1.0.0.min.js',
		'js/jquery-ui-1.10.0.custom.min.js',
		'js/jquery.ui.touch-punch.js',
//		'js/modernizr.js',
        'js/bootstrap.min.js',
//		'js/jquery.cookie.js',
//		'js/fullcalendar.min.js',
		'js/jquery.dataTables.min.js',
//		'js/excanvas.js',
//		'js/jquery.flot.js',
//		'js/jquery.flot.pie.js',
//		'js/jquery.flot.stack.js',
//		'js/jquery.flot.resize.min.js',
		'js/jquery.chosen.min.js',
		'js/jquery.uniform.min.js',
		'js/jquery.cleditor.min.js',
//		'js/jquery.noty.js',
		'js/jquery.elfinder.min.js',
//		'js/jquery.raty.min.js',
//		'js/jquery.iphone.toggle.js',
		'js/jquery.uploadify-3.1.min.js',
//		'js/jquery.gritter.min.js',
//		'js/jquery.imagesloaded.js',
//		'js/jquery.masonry.min.js',
//		'js/jquery.knob.modified.js',
//		'js/jquery.sparkline.min.js',
//		'js/counter.js',
//		'js/retina.js',
		'js/custom.js',
        'js/stan.custom.js'
	];
	public $depends = [
		'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'backend\assets\SwaltAsset'
	];
}
