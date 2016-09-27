<?php
use yii\helpers\Html;
$filter = "Poker";
$this->title = "$filter Sites";
$this->params['breadcrumbs'][] = $this->title;?>
<bonuses-filter-list params="{bonuses_list}" filter='<?= $filter ?>'></bonuses-filter-list>
