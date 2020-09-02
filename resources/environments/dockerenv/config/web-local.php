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

return $config;
