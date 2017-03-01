<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id'                  => 'app-frontend',
    'basePath'            => dirname(__DIR__),
    //'bootstrap'           => ['log', 'assetsAutoCompress'],
    'bootstrap'           => ['log'],

    'controllerNamespace' => 'frontend\controllers',
    'components'          => [
        //'assetsAutoCompress' => [
        //    'class' => '\skeeks\yii2\assetsAuto\AssetsAutoCompressComponent',
        //],
        'geoip'              => [
            'class' => 'lysenkobv\GeoIP\GeoIP'
        ],
        'starMaker'          => [
            'class' => \common\helpers\StarMaker::class
        ],
        'request'            => [
            'csrfParam' => '_csrf-frontend',
            'cookieValidationKey' => 'QuT8PzD6l6oG5x-22IsZEWDBBVumnbBd',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'user'               => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [

                '/contact' => '/site/contact',
                '/sitemap' => '/site/sitemap',

                [
                    'pattern' => '<controller>/<action:[a-zA-Z0-9\-]{0,}>',
                    'route' => '',
                    'class' => \common\components\CustomUrlRule::className()
                ],

                ['class' => 'yii\rest\UrlRule', 'controller' => 'company'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'bonus'],
            ],
        ],
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => []
                ],
            ],
        ],
    ],
    'params' => $params,
];
