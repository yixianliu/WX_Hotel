<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id'                  => 'app-api',
    'basePath'            => dirname( __DIR__ ),
    'bootstrap'           => ['log'],
    'controllerNamespace' => 'api\controllers',
    'components'          => [
        'request'      => [
            'csrfParam' => '_csrf-frontend',
        ],

        'user'         => [
            'identityClass'   => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie'  => ['name' => '_identity-api', 'httpOnly' => true],
        ],
        'session'      => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log'          => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        // Urls
        'urlManager'  => [
            // 是否开启美化效果
            'enablePrettyUrl'     => true,
            // 是否或略脚本名index.php
            'showScriptName'      => false,
            // 是否开启严格解析路由
            'enableStrictParsing' => false,
            'suffix'              => '.html',
            'rules'               => [

                // 默认
                '' => 'center/index',

                '<controller:\w+>/<action:\w+>-<id:\d+>'   => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>-<page:\d+>' => '<controller>/<action>',
                "<controller:\w+>/<action:\w+>"            => "<controller>/<action>",

            ],
        ],

    ],

    'params'              => $params,
];
