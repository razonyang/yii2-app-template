<?php

return [
    'id' => 'app-console',
    'bootstrap' => ['log', 'queue'],
    'controllerNamespace' => 'App\Console\Controller',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'controllerMap' => [
        'migrate' => [
            'class' => \yii\console\controllers\MigrateController::class,
            'templateFile' => '@resources/console/views/migration.php',
            'migrationPath' => [
                '@resources/migrations',
                '@yii/rbac/migrations',
                '@yii/log/migrations/',
            ],
            'migrationNamespaces' => [
                'RazonYang\Yii2\Log\Db\Migration',
                'RazonYang\Yii2\Setting\Migration',
            ],
        ],
        'serve' => [
            'class' => \yii\console\controllers\ServeController::class,
            'docroot' => '@webroot',
            'port' => 8080,
        ],
    ],
    'components' => [
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                'file' => [
                    'class' => yii\log\FileTarget::class,
                    'logFile' => '@runtime/logs/console.log',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
];
