<?php

return [
    'id' => 'app-tests',
    'components' => [
        'db' => [
            'dsn' => 'mysql:host=localhost;dbname=yiitest',
        ],
        'log' => [
            'traceLevel' => 3,
            'targets' => [
                'file' => [
                    'class' => yii\log\FileTarget::class,
                    'logFile' => '@runtime/logs/test.log',
                    'levels' => ['error', 'warning', 'info', 'trace'],
                ],
            ],
        ],
    ],
];
