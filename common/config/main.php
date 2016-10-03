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
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
	        'enablePrettyUrl' => true,
	        'showScriptName' => false,
          'rules' => [
        '/' => 'site/index',
        'login' => 'site/login',
        'logout' => 'site/logout',
        'signup' => 'site/signup',
        'request-password-reset' => 'site/request-password-reset',
        'reset-password' => 'site/reset-password',],
        ],
    ],
];
