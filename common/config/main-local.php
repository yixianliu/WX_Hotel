<?php
return [
    'components' => [

        'db' => [
            'class'       => 'yii\db\Connection',
            'dsn'         => 'mysql:host=localhost;dbname=sql995518',
            'username'    => 'sql995518',
            'password'    => '0e88af04',
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