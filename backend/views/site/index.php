<?php
use \common\models\Company;
use \common\models\Bonus;
use \yii\helpers\Url;
use \common\models\Review;
use \common\models\Categorie;
use \common\models\Country;

/* @var $this yii\web\View */

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="span10">
    <div class="row-fluid">
        <a class="quick-button metro blue span2" href="<?= Url::to(['company/index']) ?>">
            <i class="icon-building"></i>
            <p>Companies</p>
            <span class="badge"><?= Company::find()->count() ?></span>
        </a>
        <a class="quick-button metro yellow span2" href="<?= Url::to(['bonus/index']) ?>">
            <i class="icon-gift"></i>
            <p>Bonuses</p>
            <span class="badge"><?= Bonus::find()->count(); ?></span>
        </a>
        <a class="quick-button metro pink span2" href="<?= Url::to(['review/index']) ?>">
            <i class="icon-eye-open"></i>
            <p>Reviews</p>
            <span class="badge"><?= Review::find()->where(['type' => Review::REVIEW_TYPE])->count() ?></span>
        </a>
        <a class="quick-button metro green span2" href="<?= Url::to(['category/index']) ?>">
            <i class="icon-eye-open"></i>
            <p>Categories</p>
            <span class="badge"><?= Categorie::find()->count() ?></span>
        </a>
        <a class="quick-button metro red span2" href="<?= Url::to(['country/index']) ?>">
            <i class="icon-flag"></i>
            <p>Countries</p>
            <span class="badge"><?= Country::find()->count() ?></span>
        </a>
        <div class="clearfix"></div>
    </div>
</div>
