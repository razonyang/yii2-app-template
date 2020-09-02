<?php
return [
    'bootstrap' => ['gii'],
    'components' => [
        'log' => [
            'targets' => [
                'file' => [
                    'levels' => ['info', 'trace'],
                ],
            ],
        ],
    ],
    'modules' => [
        'gii' => require __DIR__ . '/gii.php',
    ],
];
