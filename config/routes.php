<?php

return [
    'GET /' => 'site/index',
    'GET /contact' => 'site/contact',
    'GET /about' => 'site/about',
    'GET /articles' => 'article/index',
    'GET /articles/<id:\d+>' => 'article/view',
    
    // API
    [
        'class' => \yii\web\GroupUrlRule::class,
        'prefix' => 'api/backend/v1',
        'rules' => [
            'POST upload/<action>' => 'upload/<action>',
            'POST <action:login|logout>' => 'user/<action>',
            'PUT access-token' => 'user/refresh-access-token',
            'OPTIONS <action:login|logout>' => 'user/options',

            'GET my/info' => 'my/info',
            'PUT my/password' => 'my/password',

            'POST upload/<action:images|videos>' => 'upload/<action>',
            'OPTIONS upload/<action:images|videos>' => 'upload/options',
        ],
    ],
    [
        'class' => \yii\rest\UrlRule::class,
        'controller' => [
            // backend
            'api/backend/v1/user',
            'api/backend/v1/article',
            'api/backend/v1/article-category',

            // Frontend
            'api/frontend/v1/article',
        ],
    ],
    [
        'class' => \yii\rest\UrlRule::class,
        'controller' => [
            'api/backend/v1/permission',
            'api/backend/v1/role',
            'api/backend/v1/my/sessions' => 'api/backend/v1/my-session',
            'api/backend/v1/setting',
        ],
        'tokens' => [
            '{id}' => '<id:[\\w\-\.]+>',
        ],
    ],
];
