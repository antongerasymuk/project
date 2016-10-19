<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'db' => [
            'class'    => 'yii\db\Connection',
            'dsn'      => 'mysql:host=144.76.203.79;dbname=hnzstdhf_bonus',
            'username' => 'hnzstdhf_bonus',
            'password' => '123QWEasdZXC',
            'charset'  => 'utf8',
            'enableSchemaCache' => true
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
	        'enablePrettyUrl' => true,
	        'showScriptName' => false,
        ],
    ],
];
