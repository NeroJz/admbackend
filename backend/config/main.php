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
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
           'view' => [
         'theme' => [
             'pathMap' => [
             '@app/views' => '@backend/views/'
               // '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-advanced-app'
             ],
         ],
    ],
        'authManager'=>[
        'class'=>'yii\rbac\DbManager',
        'defaultRoles'=>['guest']
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
        'gcm' => [
        'class' => 'bryglen\apnsgcm\Gcm',
        'apiKey' => 'AIzaSyDznqFTFWKBwWMr4JJbu5xTq_',
        ],
    ],
    'params' => $params,
];
