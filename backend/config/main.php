<?php

$params = array_merge(
// params
    require(__DIR__ . '/../../common/config/params.php'),
    // params local
    require(__DIR__ . '/../../common/config/params-local.php'),
    // params
    require(__DIR__ . '/params.php'),
    // params local
    require(__DIR__ . '/params-local.php')
);

return [
    'id'                  => 'app-backend',
    'basePath'            => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap'           => ['log'],
    'language'            => 'zh-CN',
    'modules'             => [],
    'components'          => [

        // 视图文件
        'view' => [

            'theme' => [
                'basePath' => '@app/backend/web/themes',
                'baseUrl'  => '@web/backend/views/themes',
                'pathMap'  => [

                    '@app/views' => [

                        // 默认
                        '@app/views/manage',
                    ],

                ],
            ],

        ],

        'request' => [
            'csrfParam' => '_csrf-backend',
        ],

        'user' => [
            'identityClass'   => 'common\models\Management',
            'enableAutoLogin' => true,
            'identityCookie'  => ['name' => '_identity-backend', 'httpOnly' => true],
        ],

        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],

        'urlManager'  => [
            'enablePrettyUrl' => true,
            'showScriptName'  => true,
            "rules"           => [

                // 默认
                '' => 'center/index',
            ],
        ],

        // components数组中加入authManager组件,有PhpManager和DbManager两种方式,
        // PhpManager将权限关系保存在文件里,这里使用的是DbManager方式,将权限关系保存在数据库.
        'authManager' => [
            'class'           => 'yii\rbac\DbManager',
            'defaultRoles'    => ['guest'],

            // Mysql 表
            'itemTable'       => 'w_auth_role', // 角色 + 权限
            'assignmentTable' => 'w_management', // 用户
            'itemChildTable'  => 'w_auth_role_permisson', // 关联
            'ruleTable'       => 'w_auth_rule', // 规则
        ],

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],

        'errorHandler' => [
            'errorAction' => 'error/index',
        ],

    ],

    'params' => $params,
];
