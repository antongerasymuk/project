<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
//        'db' => [
//            'class' => 'yii\db\Connection',
//            'dsn' => 'mysql:host=144.76.203.79;dbname=hnzstdhf_bonus',
//            'username' => 'hnzstdhf_bonus',
//            'password' => '123QWEasdZXC',
//            'charset' => 'utf8',
//        ],
//        'cache' => [
//            'class' => 'yii\caching\FileCache',
//        ],
        'cache' => [
            'class' => 'yii\caching\ApcCache',
            'useApcu' => true
        ],
        'urlManager' => [
	        'enablePrettyUrl' => true,
	        'showScriptName' => false,
          'rules' => [
          'page/<category>/<slug>' => 'site/page',
        '/' => 'site/index',
        'login' => 'site/login',
        'logout' => 'site/logout',
        'signup' => 'site/signup',
        'request-password-reset' => 'site/request-password-reset',
        'reset-password' => 'site/reset-password',],
        ],
    ],
];
