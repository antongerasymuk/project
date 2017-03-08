<?php
namespace common\helpers;

use yii\helpers\Url;

class AddGTM
{
    public static function generate($parrentTag, $GTMID)
    {
        $html = '';  
        
        if ($parrentTag == 'head') {

           $html .= "<!-- Google Tag Manager -->
            <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
               new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
               j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
               'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
           })(window,document,'script','dataLayer','GTM-".$GTMID."');</script>
           <!-- End Google Tag Manager -->";

        } elseif ($parrentTag == 'body') {

           $html .= "<!-- Google Tag Manager (noscript) -->
           <noscript><iframe src='https://www.googletagmanager.com/ns.html?id=GTM-".$GTMID."'
           height='0' width='0' style='display:none;visibility:hidden'></iframe></noscript>
           <!-- End Google Tag Manager (noscript) -->";
        }

        return $html;
    }
}
