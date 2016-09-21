<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AdminAsset;
use yii\helpers\Html;
use yii\helpers\Url;

AdminAsset::register( $this );
?>

<?php $this->beginPage() ?>
	<!DOCTYPE html>
	<html lang="<?= Yii::$app->language ?>">
	<head>
		<!-- start: Meta -->
		<meta charset="<?= Yii::$app->charset ?>">
		<?= Html::csrfMetaTags() ?>
		<title><?= Html::encode( $this->title ) ?></title>
		<!-- end: Meta -->

		<!-- start: Mobile Specific -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- end: Mobile Specific -->

		<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="css/ie.css" rel="stylesheet">
		<![endif]-->

		<!--[if IE 9]>
		<link id="ie9style" href="css/ie9.css" rel="stylesheet">
		<![endif]-->
		<!-- start: Favicon -->
		<link rel="shortcut icon" href="images/favicon.ico">
		<!-- end: Favicon -->
		<style type="text/css">
			body { background: url(<?= \Yii::$app->urlManager->baseUrl ?>/images/bg-login.jpg) !important; }
		</style>
		<?php $this->head() ?>
	</head>
	<body>
	<?php $this->beginBody() ?>
	<!-- start: Header -->
	<div class="container-fluid-full">
		<div class="row-fluid"><?= $content ?></div><!--/.fluid-container-->

	</div>
	<?php $this->endBody() ?>
	</body>
	</html>
<?php $this->endPage() ?>