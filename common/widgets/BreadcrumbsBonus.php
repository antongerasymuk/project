<?php
namespace common\widgets;

class BreadcrumbsBonus extends \yii\widgets\Breadcrumbs {
public $tag = 'div';
public $options = ['class' => 'breadcrumbs'];
public $itemTemplate = "{link}<span>›</span>\n";
/**
 * @var string the template used to render each active item in the breadcrumbs. The token `{link}`
 * will be replaced with the actual HTML link for each active item.
 */
public $activeItemTemplate = "{link}\n";
}
