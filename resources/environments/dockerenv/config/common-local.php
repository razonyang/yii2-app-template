<?php
return [
    'components' => [
        'db' => [
            'dsn' => 'mysql:host=' + getenv('DB_HOST') + ';dbname=' + getenv('DB_NAME'),
            'username' => getenv('DB_USER'),
            'password' => getenv('DB_PASSWORD'),
            'enableSchemaCache' => true,
        ],
        'mailer' => [
            'useFileTransport' => true,
            'transport' => [
                'host' => getenv('MAILER_HOST'),
                'port' => getenv('MAILER_PORT'),
                'encryption' => 'ssl',
                'username' => getenv('MAILER_USER'),
                'password' => getenv('MAILER_PASSWORD'),
            ],
        ],
        'redis' => [
            'hostname' => getenv("REDIS_HOST"),
            'port' => 6379,
            'database' => getenv("REDIS_DB"),
        ],
        'uploader' => [
            'host' => getenv("UPLOADER_HOST"),
            'filesystem' => [
                'class' => \creocoder\flysystem\LocalFilesystem::class,
                'path' => '@webroot/resources',
            ],
        ],
    ],
];
