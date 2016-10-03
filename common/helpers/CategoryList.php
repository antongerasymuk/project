<?php
namespace common\helpers;

use yii\helpers\Url;

class CategoryList
{
    public static function generate($items)
    {
        $html = '';

        $length = count($items);

        for ($i = 0; $i < $length; $i++) {
            $point = $i != $length - 1 ? ',&nbsp;' : '';

            $html .= '<a href="' . Url::to($items[$i]['url']) . '">' . $items[$i]['label'] . $point . '</a>';
        }

        return $html;
    }
}