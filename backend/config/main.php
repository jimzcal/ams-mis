<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log', 'thumbnail'],
    // 'homeUrl' => '/admin', uncomment this when go on live
    'modules' => [
        'pdfjs' => ['class' => '\yii2assets\pdfjs\Module',],
        'rbac' => [
            'class' => 'dektrium\rbac\RbacWebModule',
        ],
        'user' => [
            'class'  => 'dektrium\user\Module',
            'admins' => ['admin'],
            'enableFlashMessages' => false,
        ],
        'gridview' => ['class' => 'kartik\grid\Module'],
        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['127.0.0.1', '::1', '172.17.108.180'],
        ],

    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            // 'baseUrl' => 'http://acctg.da.gov.ph/backend/web', uncomment this when go on live
            ],

            'thumbnail' => [
                'class' => 'himiklab\thumbnail\EasyThumbnail',
                'cacheAlias' => 'assets/gallery_thumbnails',
                ],
    
        // 'user' => [
        //     'identityClass' => 'backend\models\User',
        //     'enableAutoLogin' => true,
        //     'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        // ],
            'session' => [
                // this is the name of the session cookie used for login on the backend
                'name' => 'advanced-backend',
            ],

            'authManager'  => [
                    'class' => 'dektrium\rbac\components\DbManager',
                    ],

             'request' => [
                // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
                'cookieValidationKey' => 'DA-AMS',
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
                'class' => 'yii\web\UrlManager',
                // 'baseUrl' => 'http://acctg.da.gov.ph/backend/web', uncomment this when go on live
                'enablePrettyUrl' => true,
                'showScriptName' => false,
                // 'suffix'=>'.html',
                'enablePrettyUrl' => true,
                'rules' => [
                        '<controller:\w+>/<action:[\w\-]+>' => '<controller>/<action>',
                        '<controller:\w+>/<action:[\w\-]+>/<id:[\d\-]+>' => '<controller>/<action>',
                        '<controller:\w+>/<action:[\w\-]+>/<nca_no:[\nca_no\-]+>' => '<controller>/<action>',
                        '<controller:[\w\-]+>/<id:\d+>' => '<controller>/view',
                        '<controller:[\w\-]+>/<nca_no:\nca_no+>' => '<controller>/view',
                    ],
            ],
    ],
    'params' => $params,
];
