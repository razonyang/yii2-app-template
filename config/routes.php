<?php

return [
    'GET /' => 'site/index',
    'GET /captcha' => 'site/captcha',
    'GET,POST /contact' => 'site/contact',
    'GET,POST /login' => 'site/login',
    'POST /logout' => 'site/logout',
    'GET,POST /signup' => 'site/signup',
    'GET,POST /reset-password' => 'site/reset-password',
    'GET,POST /request-password-reset' => 'site/request-password-reset',
    'GET /verify-email' => 'site/verify-email',
    'GET,POST /resend-verification-email' => 'site/resend-verification-email',
    'GET /about' => 'site/about',

    'GET /articles' => 'article/index',
    'GET /articles/<id:\d+>' => 'article/view',
    'GET /articles/<id:\d+>/comments' => 'article/comments',
    
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

            // frontend
            'api/frontend/v1/article-comment',
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

    [
        'class' => \yii\rest\UrlRule::class,
        'controller' => [
            'api/frontend/v1/article',
        ],
        'extraPatterns' => [
            'PUT {id}/likes' => 'like',
            'DELETE {id}/likes' => 'dislike',
        ],
    ],
];
