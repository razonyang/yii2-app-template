<?php

$params = array_merge(
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

$env = array_merge(
    require __DIR__ . '/env.php',
    require __DIR__ . '/env-local.php'
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
            'dsn' => $env['db.dsn'],
            'username' => $env['db.username'],
            'password' => $env['db.password'],
            'charset' => $env['db.charset'],
            'tablePrefix' => $env['db.tablePrefix'],
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
            'useFileTransport' => $env['mailer.useFileTransport'],
            'transport' => [
                'class' => \Swift_SmtpTransport::class,
                'host' => $env['mailer.host'],
                'port' => $env['mailer.port'],
                'encryption' => $env['mailer.encryption'],
                'username' => $env['mailer.username'],
                'password' => $env['mailer.password'],
            ],
            'setting' => 'settingManager',
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
            'hostname' => $env['redis.hostname'],
            'port' => $env['redis.port'],
            'database' => $env['redis.database'],
            'password' => $env['redis.password'],
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
            'host' => $params['uploader.host'],
            'filesystem' => [
                'class' => \creocoder\flysystem\LocalFilesystem::class,
                'path' => '@webroot/resources',
            ],
        ],
    ],
    'params' => $params,
];
