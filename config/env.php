<?php

return [
    // database
    'db.dsn' => 'mysql:host=localhost;dbname=yii',
    'db.username' => 'root',
    'db.password' => '',
    'db.charset' => 'utf8mb4',
    'db.tablePrefix' => 't_',

    // redis
    'redis.hostname' => 'localhost',
    'redis.port' => 6379,
    'redis.database' => 0,
    'redis.password' => '',

    // mailer
    'mailer.useFileTransport' => false,
    'mailer.host' => 'smtp.example.com',
    'mailer.port' => 25,
    'mailer.encryption' => 'ssl',
    'mailer.username' => 'admin@example.com',
    'mailer.password' => '',
];
