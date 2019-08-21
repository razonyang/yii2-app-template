<?php

return [
    // database
    'db.dsn' => 'mysql:host=db;dbname=yii',
    'db.username' => 'root',
    'db.password' => 'foobar',

    // redis
    'redis.hostname' => 'redis',
    'redis.port' => 6379,
    'redis.database' => 0,
    'redis.password' => 'foobar',

    // mailer
    'mailer.useFileTransport' => true,
    'mailer.host' => 'smtp.example.com',
    'mailer.port' => 25,
    'mailer.encryption' => 'ssl',
    'mailer.username' => 'admin@example.com',
    'mailer.password' => '',
];
