<?php

return [
    'id' => 'app-api',
    'bootstrap' => ['log', 'contentNegotiator'],
    'controllerNamespace' => 'App\Http\Controller',
    'viewPath' => '@resources/views',
    'modules' => [
        'api' => [
            'class' => \App\Http\Api\Module::class,
            'modules' => [
                'backend' => [
                    'class' => \App\Http\Api\Backend\Module::class,
                    'modules' => [
                        'v1' => \App\Http\Api\Backend\Module\V1\Module::class,
                    ],
                ],
                'frontend' => [
                    'class' => \App\Http\Api\Frontend\Module::class,
                    'modules' => [
                        'v1' => \App\Http\Api\Frontend\Module\V1\Module::class,
                    ],
                ],
            ],
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-web',
            'parsers' => [
                'application/json' => \yii\web\JsonParser::class,
                'multipart/form-data' => \yii\web\MultipartFormDataParser::class,
            ],
        ],
        'response' => [
            'format' => \yii\web\Response::FORMAT_HTML,
            'formatters' => [
                \yii\web\Response::FORMAT_JSON => \RazonYang\Yii2\JSend\Formatter::class,
            ],
        ],
        'contentNegotiator' => [
            'class' => \App\Http\Filter\ContentNegotiator::class,
            'formatParam' => 'format',
            'formats' => [
                'text/html' => 'html',
                'application/json' => 'json',
            ],
            'languages' => ['zh-CN', 'zh-TW', 'en'],
            'languageParam' => 'lang',
        ],
        'user' => [
            'identityClass' => \App\Model\User::class,
            'enableAutoLogin' => false,
            'enableSession' => true,
            'identityCookie' => ['name' => '_identity-web', 'httpOnly' => true],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                'file' => [
                    'class' => 'yii\log\FileTarget',
                    'logFile' => '@runtime/logs/web.log',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'class' => \RazonYang\Yii2\JSend\ErrorHandler::class,
            'errorAction' => 'site/error',
        ],
        'i18n' => [
            'translations' => [
                'api' => [
                    'class' => \yii\i18n\PhpMessageSource::class,
                    'basePath' => '@resources/messages',
                    'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'api' => 'api.php',
                    ],
                ],
            ],
        ],
        'urlManager' => [
            'class' => \yii\web\UrlManager::class,
            'cache' => false,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'rules' => require __DIR__ . '/routes.php',
        ],
        'jsend' => function () {
            return new \RazonYang\Jsend\Jsend();
        },
    ],
];
