
<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;


$this->title = 'SiteMap';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
	<div class="static-content">
       <bookmaker-bonuses-list params="{companies_list}"></bookmaker-bonuses-list>
       <?php $this->registerJsFile('/js/bookmaker_bonuses_list.js', ['depends' => [frontend\assets\AppAsset::className()]]); ?>
   
      

		<h3>Other</h3>
		<div class="bonuses-other-items">
        <?= \common\widgets\BonusesOtherItems::widget([
									'items' => \common\models\Categorie::getForNav()
									]) ?>
        <?= \common\widgets\OtherItems::widget([
									'items' => \common\models\Site::getForOther()
									]) ?>
			
				

		</div> <!-- .bonuses-other-items -->
	</div>
</div>