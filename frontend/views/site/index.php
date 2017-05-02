<?php

use common\models\Company;
use common\helpers\SiteText;
use common\models\SiteNumber;

?>

<script>
    cdnHost = '<?= \Yii::$app->params['cdnHost'] ?>';
    console.log(cdnHost);
</script>

<companies-list   title="<?= SiteText::get('main_list_title');?>"  count="<?= SiteNumber::find()->where(['type' => 1])->one()->value ?>"></companies-list>
<!--<?php //$this->registerJsFile('/js/companies_list.js', ['depends' => [frontend\assets\AppAsset::className()]]); ?>-->

<!-- .betting-sites-items -->

<div class="static-content">
    <?= SiteText::get('main_text'); ?>
</div><!-- .static-content -->

</div>
