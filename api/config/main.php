<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id'                  => 'app-frontend',
    'basePath'            => dirname(__DIR__),
    'bootstrap'           => ['log'],
    'controllerNamespace' => 'api\controllers',
    'components'          => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'parsers'   => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'user'    => [
            'identityClass'   => 'common\models\User',
            'enableAutoLogin' => true,
            'enableSession'   => false,
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

        // ...
        'wechat'       => [
            'class' => 'maxwen\easywechat\Wechat',
            // 'userOptions' => []  # user identity class params
            // 'sessionParam' => '' # wechat user info will be stored in session under this key
            // 'returnUrlParam' => '' # returnUrl param stored in session
        ],

        'urlManager' => [
            'enablePrettyUrl'     => true,
            'enableStrictParsing' => true,
            'showScriptName'      => false,
            'rules'               => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'room'],
            ],
        ],

    ],
    'params'              => $params,
];
