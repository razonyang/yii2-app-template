<?php

return [
    /* ============================== common ============================== */
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',

    // user
    'user.session.duration' => 7200, // session's duration in seconds, default to 2 hours.
    'user.session.refreshTokenDuration' => 403200, // refresh token's duration in seconds, default to a week.
    'user.session.durationAfterRefresh' => 300, // old session's remaining durantion after refreshing session, default to 5 minutes.

    /* ============================= backend ============================== */
    'backend.url' => 'http://localhost',

    /* =============================== API =============================== */
    // CORS
    'api.cors.origin' => ['*'],
    'api.cors.methods' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
    'api.cors.headers' => ['Content-Type', 'Authorization'],
    'api.cors.allowCredentials' => null,
    'api.cors.maxAge' => 86400,
    'api.cors.exposeHeaders' => [],

    // rate limiter
    'api.rateLimiter.capacity' => 5000,
    'api.rateLimiter.rate' => 0.72,
    'api.rateLimiter.limitPeriod' => 3600,
    'api.rateLimiter.ttl' => 3600,
    'api.rateLimiter.prefix' => 'rate_limiter:',
];
