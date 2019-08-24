<?php
return [
    'components' => [
        'db' => [
            'dsn' => 'mysql:host=db;dbname=yii',
            'username' => 'root',
            'password' => 'foobar',
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
            'hostname' => 'redis',
            'port' => 6379,
            'database' => 0,
            'password' => 'foobar',
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
