<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AdminAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

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
		<?php $this->head() ?>
	</head>
	<body>
	<?php $this->beginBody() ?>
	<!-- start: Header -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<!-- start: Header Menu -->
				<div class="nav-no-collapse header-nav">
					<a class="brand" href="<?= Url::to(['site/index']) ?>"><span>Bonus Dashboard</span></a>
				</div>
				<!-- end: Header Menu -->
			</div>
		</div>
	</div>
	<!-- start: Header -->

	<div class="container-fluid-full">
		<div class="row-fluid">

			<!-- start: Main Menu -->
			<div id="sidebar-left" class="span2">
				<div class="nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li>
							<a href="<?= Url::to(['site/index']) ?>">
								<i class="icon-bar-chart"></i>
								<span class="hidden-tablet">Dashboard</span>
							</a>
						</li>
						<li>
							<a href="<?= Url::to(['company/index']) ?>">
								<i class="icon-building"></i>
								<span class="hidden-tablet">Companies</span>
							</a>
						</li>
						<li>
							<a href="<?= Url::to(['page/index']) ?>">
								<i class="icon-file"></i>
								<span class="hidden-tablet">Pages</span>
							</a>
						</li>
						<li>
							<a href="<?= Url::to(['category/index']) ?>">
								<i class="icon-book"></i>
								<span class="hidden-tablet">Categories</span>
							</a>
						</li>
						<li>
							<a href="<?= Url::to(['country/index']) ?>">
								<i class="icon-flag"></i>
								<span class="hidden-tablet">Countries</span>
							</a>
						</li>
						<li>
							<a href="<?= Url::to(['os/index']) ?>">
								<i class="icon-desktop"></i>
								<span class="hidden-tablet">Operating systems</span>
							</a>
						</li>
						<li>
							<a href="<?= Url::to(['review/index']) ?>">
								<i class="icon-credit-card"></i>
								<span class="hidden-tablet">Reviews</span>
							</a>
						</li>
						<li>
							<a href="<?= Url::to(['payment/index']) ?>">
								<i class="icon-credit-card"></i>
								<span class="hidden-tablet">Payment methods</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
			<!-- end: Main Menu -->

			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
						enabled to use this site.</p>
				</div>
			</noscript>
			<!-- start: Content -->
			<div id="content" class="span10">
                <!-- Breadcrumbs here -->
				<div class="row-fluid"><?= $content ?></div>
			</div><!--/.fluid-container-->

			<!-- end: Content -->
		</div><!--/#content.span10-->
	</div><!--/fluid-row-->

	<div class="modal hide fade" id="myModal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Settings</h3>
		</div>
		<div class="modal-body">
			<p>Here settings can be configured...</p>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
			<a href="#" class="btn btn-primary">Save changes</a>
		</div>
	</div>
	<div class="clearfix"></div>
	<footer>
		<p>
			<span style="text-align:left;float:left">© 2016 <a href="#" alt="">Bonus</a></span>
		</p>
	</footer>
	<?php $this->endBody() ?>
	</body>
	</html>
<?php $this->endPage() ?>