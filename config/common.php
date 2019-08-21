<?php

$params = array_merge(
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

$root = dirname(__DIR__);

return [
    'aliases' => [
        '@root' => $root,
        '@App' => '@root/app',
        '@resources' => '@root/resources',
        '@webroot' => '@root/public',
        '@web' => '@root/public',
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'basePath' => $root,
    'vendorPath' => $root . '/vendor',
    'runtimePath' => $root . '/runtime',
    'name' => 'Yii Application',
    'timezone' => 'Asia/Shanghai',
    'language' => 'zh-CN',
    'sourceLanguage' => 'en',
    'components' => [
        'cache' => [
            'class' => \yii\redis\Cache::class,
        ],
        'db' => [
            'class' => \yii\db\Connection::class,
            'dsn' => 'mysql:host=localhost;dbname=yii',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8mb4',
            'tablePrefix' => 't_',
            'enableSchemaCache' => YII_DEBUG ? false : true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                'db' => [
                    'class' => \RazonYang\Yii2\Log\Db\Target::class,
                    'levels' => ['error', 'warning'],
                    'db' => 'db',
                    'logTable' => '{{%log}}',
                ],
            ],
        ],
        'mailer' => [
            'class' => \yii\swiftmailer\Mailer::class,
            'viewPath' => '@resources/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => YII_DEBUG ? true : false,
            'transport' => [
                'class' => \Swift_SmtpTransport::class,
                'host' => 'smtp.example.com',
                'port' => 25,
                'encryption' => 'ssl',
                'username' => 'admin@example.com',
                'password' => '',
            ],
        ],
        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => \yii\i18n\PhpMessageSource::class,
                    'basePath' => '@resources/messages',
                    'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'app' => 'app.php'
                    ],
                ],
            ],
        ],
        'redis' => [
            'class' => \yii\redis\Connection::class,
            'hostname' => 'localhost',
            'port' => 6379,
            'database' => 0,
            // 'password' => '',
        ],
        'mutex' => [
            'class' => \yii\redis\Mutex::class,
            'redis' => 'redis',
        ],
        'settingManager' => [
            'class' => \RazonYang\Yii2\Setting\DbManager::class,
            'enableCache' => YII_DEBUG ? false : true,
            'cache' => 'cache',
            'mutex' => 'mutex',
            'duration' => 600,
            'db' => 'db',
            'settingTable' => '{{%setting}}',
        ],
        'queue' => [
            'class' => \yii\queue\redis\Queue::class,
            'as log' => \yii\queue\LogBehavior::class,
            'redis' => 'redis',
            'channel' => 'queue',
        ],
        'authManager' => [
            'class' => yii\rbac\DbManager::class,
        ],
        'uploader' => [
            'class' => \RazonYang\Yii2\Uploader\Uploader::class,
            'host' => 'http://localhost/resources',
            'filesystem' => [
                'class' => \creocoder\flysystem\LocalFilesystem::class,
                'path' => '@webroot/resources',
            ],
        ],
    ],
    'params' => $params,
];
