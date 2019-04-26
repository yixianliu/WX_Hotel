<?php
return [
    'components' => [

        'db' => [
            'class'       => 'yii\db\Connection',
            'dsn'         => 'mysql:host=localhost;dbname=sql347002',
            'username'    => 'sql347002',
            'password'    => '7bc93183',
            'charset'     => 'utf8',
            'tablePrefix' => 'W_', // 表前缀：t_
        ],

        'mailer' => [
            'class'            => 'yii\swiftmailer\Mailer',
            'viewPath'         => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
];