<?php
return [
    'components' => [
        'db' => [
            'dsn' => 'mysql:host=localhost;dbname=yii',
            'username' => 'root',
            'password' => '',
            'enableSchemaCache' => false,
        ],
        'mailer' => [
            'useFileTransport' => true,
            'transport' => [
                'host' => 'smtp.example.com',
                'port' => 25,
                'encryption' => 'ssl',
                // 'username' => 'admin@example.com',
                'password' => '',
            ],
        ],
        'redis' => [
            'hostname' => 'localhost',
            'port' => 6379,
            'database' => 0,
            'password' => '',
        ],
        'uploader' => [
            'host' => 'http://localhost:8080/resources',
            'filesystem' => [
                'class' => \creocoder\flysystem\LocalFilesystem::class,
                'path' => '@webroot/resources',
            ],
        ],
    ],
];
