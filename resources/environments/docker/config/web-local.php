<?php

$config = [
    'components' => [
        'log' => [
            'targets' => [
                'file' => [
                    'levels' => ['info', 'trace'],
                ],
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
        ],
    ],
];

if (YII_ENV_DEV) {
    $allowedIPs = ['127.0.0.1', '::1'];

    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = array_merge(require __DIR__ . '/debug.php', [
        'allowedIPs' => $allowedIPs
    ]);

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] =  array_merge(require __DIR__ . '/gii.php', [
        'allowedIPs' => $allowedIPs
    ]);
}

return $config;
