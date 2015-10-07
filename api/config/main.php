<?php

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            'basePath' => '@app/modules/v1',
            'class' => 'api\modules\v1\Module'
        ]
    ],

    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
        ],
        'gcm' => [
            'class' => 'bryglen\apnsgcm\Gcm',
            'apiKey' => 'AIzaSyDznqFTFWKBwWMr4JJbu5xTq_',
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
        'request' => [
            'class' => '\yii\web\Request',
            'enableCookieValidation' => false,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/user'

                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/personalinformation'

                ],


                'POST v1/user/login' => 'v1/user/login',
                'GET v1/user/getalluser' => 'v1/user/getalluser',
                'GET v1/institution/getallinstitution' => 'v1/institution/getallinstitution',
                'GET v1/institution/getalluniversities' => 'v1/institution/getalluniversities',
                'GET v1/institution/getedulevel' => 'v1/institution/getedulevel',
                'GET v1/institution/getallcourse' => 'v1/institution/getallcourse',
                'POST v1/institution/inserteducationinfo' => 'v1/institution/inserteducationinfo',
                'POST v1/institution/addnewuniversity' => 'v1/institution/addnewuniversity',
                'POST v1/institution/addnewinstitution' => 'v1/institution/addnewinstitution',
                'POST v1/institution/addnewcourse' => 'v1/institution/addnewcourse',
                'POST v1/workinginformation/insertworkinginfo' => 'v1/workinginformation/insertworkinginfo',
                'POST v1/messagerooms/getmessageroom' => 'v1/messagerooms/getmessageroom',
                'GET v1/personalinformation/getall' => 'v1/personalinformation/getall',
                'GET v1/personalinformation/getbasedonindexchat/<from:\\w+>' => 'v1/personalinformation/getbasedonindexchat/',
                'POST v1/personalinformation/getbasedonindex/<from:\\w+>' => 'v1/personalinformation/getbasedonindex/',
                'GET v1/personalinformation/getnumberofrows' => 'v1/personalinformation/getnumberofrows',
                'GET v1/user/geteducationsinfo/<pi_id:\\w+>' => 'v1/user/geteducationsinfo',
                'GET v1/user/getworkingsinfo/<pi_id:\\w+>' => 'v1/user/getworkingsinfo',
                'GET v1/user/getpersonalinfo/<pi_id:\\w+>' => 'v1/user/getpersonalinfo',
                'GET v1/user/getallinfo/<pi_id:\\w+>' => 'v1/user/getallinfo',
                'GET v1/user/getcourse/<user_id:\\w+>' => 'v1/user/getcourse',
                'GET v1/user/getuserinfo/<pi_id:\\w+>' => 'v1/user/getuserinfo',
                'GET v1/user/geteducationdetail/<ei_id:\\w+>' => 'v1/user/geteducationdetail',
                'GET v1/personalinformation/getuserbyname/<pi_name:\\w+>' => 'v1/personalinformation/getuserbyname',
                'POST v1/personalinformation/searchuser' => 'v1/personalinformation/searchuser',
                'POST v1/personalinformation/searchallusers' => 'v1/personalinformation/searchallusers',
                'PUT v1/personalinformation/updatepersonalinfo/<pi_id:\\w+>' => 'v1/personalinformation/updatepersonalinfo',
                'POST v1/messagerooms/getallmessagerooms' => 'v1/messagerooms/getallmessagerooms',
                'GET v1/messagerooms/getlatestmessage/<mr_id:\\w+>' => 'v1/messagerooms/getlatestmessage',
                'GET v1/messagerooms/getmessages/<mr_id:\\w+>' => 'v1/messagerooms/getmessages',
                'POST v1/messagerooms/sendmessage/' => 'v1/messagerooms/sendmessage',
                'POST v1/messagerooms/insertmessageroom/' => 'v1/messagerooms/insertmessageroom',
                'POST v1/messagerooms/messageinsert' => 'v1/messagerooms/messageinsert',
                'POST v1/user/listsocialmedia/' => 'v1/user/listsocialmedia',
                'POST v1/user/getallsocialmediaplatform/' => 'v1/user/getallsocialmediaplatform',
                'PUT v1/user/updateusersocialmedia' => 'v1/user/updateusersocialmedia',
                'POST v1/user/insertnewsocialmedia/' => 'v1/user/insertnewsocialmedia',
                'POST v1/pushnotification/sendpush/' => 'v1/pushnotification/sendpush',
                'POST v1/user/deletesocialmedia/' => 'v1/user/deletesocialmedia',
                'GET v1/user/getlastupdatedate/<user_id:\\w+>' => 'v1/user/getlastupdatedate',
                'PUT v1/user/updatelastdate/<user_id:\\w+>' => 'v1/user/updatelastdate',
                'GET v1/workinginformation/getjsname/<js_id:\\w+>' => 'v1/workinginformation/getjsname',
                'POST v1/user/populateeducationinputs' => 'v1/user/populateeducationinputs',
                'PUT v1/user/updateworkingstatus' => 'v1/user/updateworkingstatus',
                'POST v1/workinginformation/getalljobspecialisation' => 'v1/workinginformation/getalljobspecialisation',
                'POST v1/personalinformation/getnumberofrowsbrowse' => 'v1/personalinformation/getnumberofrowsbrowse',
                'POST v1/personalinformation/updatecertificationinfo' => 'v1/personalinformation/updatecertificationinfo',
                'POST v1/personalinformation/deletecertification' => 'v1/personalinformation/deletecertification',
                'POST v1/personalinformation/updateskill' => 'v1/personalinformation/updateskill',
                'POST v1/personalinformation/deleteskill' => 'v1/personalinformation/deleteskill',
                'POST v1/institution/deleteeducationinfo' => 'v1/institution/deleteeducationinfo',
                'POST v1/institution/insertusereducationinfo' => 'v1/institution/insertusereducationinfo'
            ],
        ]
    ],
    'params' => $params,
];