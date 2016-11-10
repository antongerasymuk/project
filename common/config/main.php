<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'db' => [
            'class'    => 'yii\db\Connection',
            'dsn'      => 'mysql:host=localhost;dbname=yii2advancedbonus',
            'username' => 'root',
            'password' => '68719101',
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
