<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=bonus',
            'username' => 'root',
            'password' => 'slavunia',
            'charset' => 'utf8',
        ],
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
